<?php

namespace App\Http\Controllers;

use App\Actions\AHP\AnalyticalHierarchyProcessInstance;
use App\Actions\AHP\EvaluationResults;
use App\Enums\ApplicationStatusEnum;
use App\Http\Requests\InternshipApplicant\StoreApplicantSelectionResultRequest;
use App\Models\Application;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class InternshipApplicantController extends Controller implements HasMiddleware
{
    use EvaluationResults;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:view internship-applicants', only: ['index', 'show', 'print']),
            new Middleware('can:selection internship-applicants', only: ['applicantSelection', 'processSelection']),
            new Middleware('can:print internship-applicants', only: ['print']),
        ];
    }

    /**
     * @throws \Throwable
     */
    public function index(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()
            ->with('user', 'education')
            ->latest()
            ->paginate($perPage);

        $this->clearEvaluationResults();

        return view('pages.internship-applicant.index', compact('data'));
    }

    public function show(string $hashedId): View
    {
        $data['application'] = Application::query()
            ->with('user', 'education')
            ->find(hashIdsDecode($hashedId));

        return view('pages.internship-applicant.show', compact('data'));
    }

    public function print(string $hashedId): View
    {
        $data['application'] = Application::query()
            ->with('user', 'education')
            ->find(hashIdsDecode($hashedId));

        return view('pages.internship-applicant.print', compact('data'));
    }

    /**
     * @throws \Throwable
     */
    public function applicantSelection(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()
            ->with('user', 'education')
            ->latest('id')
            ->paginate($perPage);

        $this->clearEvaluationResults();

        return view('pages.internship-applicant.selection', compact('data'));
    }

    /**
     * @throws \Throwable
     */
    public function processSelection(Request $request, AnalyticalHierarchyProcessInstance $AHPAction): RedirectResponse
    {
        $this->clearEvaluationResults();

        $filters = null;

        $applicationDateRange = $request->input('application_date_range');
        $gender = $request->input('gender', 'all');

        if ($applicationDateRange) {
            $explode = explode(' - ', $applicationDateRange);
            $startDate = $explode[0];
            $endDate = $explode[1] ?? $explode[0];

            $filters['start_date'] = $startDate;
            $filters['end_date'] = $endDate;
        }
        if ($gender !== 'all') {
            $filters['gender'] = $gender;
        }

        // Calculate AHP
        $result = $AHPAction->calculateAHP($filters);

        if ($result->isNotEmpty()) {
            notify()->success(
                __('internship-applicant.notify.messages.process_selection.success'),
                __('internship-applicant.notify.title.success')
            );

            return redirect()->route('internship-applicants.applicant-selection-result', $filters);
        }

        throw ValidationException::withMessages([
            'application_date_range' => trans('validation.custom.application_date_range.empty_applications'),
        ]);
    }

    public function applicantSelectionResult(Request $request): View|RedirectResponse
    {
        $perPage = $request->query('perPage', 10);

        if ($this->fetchEvaluationResults()
            ->count() > 0) {
            $applicationIds = $this->fetchEvaluationResults()
                ->map(fn ($item) => hashIdsDecode($item['application_id']))
                ->toArray();
            $data['evaluation_results'] = Score::query()
                ->with('application.user', 'application.education')
                ->whereIn('application_id', $applicationIds)
                ->orderByDesc('final_score')
                ->paginate($perPage);

            $data['threshold_value'] = round($this->fetchEvaluationResults()
                ->avg('final_score') * 100, 2);

        } else {

            notify()->error(
                __('internship-applicant.notify.messages.process_selection.error'),
                __('internship-applicant.notify.title.error')
            );

            return redirect()->back();
        }

        return view('pages.internship-applicant.selection-result', compact('data'));
    }

    /**
     * @throws \Throwable
     */
    public function storeApplicantSelectionResult(StoreApplicantSelectionResultRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $thresholdValue = $data['threshold_value'] / 100;

        $evaluationResults = $this->fetchEvaluationResults();

        try {
            DB::transaction(function () use ($thresholdValue, $evaluationResults) {
                foreach ($evaluationResults as $result) {

                    $status = $result['final_score'] >= $thresholdValue
                        ? ApplicationStatusEnum::ACCEPTED->value
                        : ApplicationStatusEnum::REJECTED->value;

                    Application::query()
                        ->find(hashIdsDecode($result['application_id']))
                        ->update(['status' => $status]);
                }
            });

            $this->flushSessionEvaluationResults();

            notify()->success(
                __('internship-applicant.notify.messages.applicant_selection_result.success'),
                __('internship-applicant.notify.title.success')
            );

            return redirect()->route('internship-applicants.index');

        }catch (\Throwable $throwable){
            notify()->error(
                __('internship-applicant.notify.messages.applicant_selection_result.error'),
                __('internship-applicant.notify.title.error')
            );

            return redirect()->back();
        }
    }
}
