<?php

namespace App\Http\Controllers;

use App\Actions\AHP\EvaluationResults;
use App\Actions\AHP\AnalyticalHierarchyProcessInstance;
use App\Actions\Collection\CollectionPaginator;
use App\Models\Application;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()->with('user', 'education')->latest()->paginate($perPage);

        $this->flushEvaluationResults();

        return view('pages.internship-applicant.index', compact('data'));
    }

    public function show(string $hashedId): View
    {
        $data['application'] = Application::query()->with('user', 'education')->find(hashIdsDecode($hashedId));

        return view('pages.internship-applicant.show', compact('data'));
    }

    public function print(string $hashedId): View
    {
        $data['application'] = Application::query()->with('user', 'education')->find(hashIdsDecode($hashedId));

        return view('pages.internship-applicant.print', compact('data'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     * @throws \Throwable
     */
    public function applicantSelection(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()->with('user', 'education')
            ->latest('id')
            ->paginate($perPage);

        $this->flushEvaluationResults();

        return view('pages.internship-applicant.selection', compact('data'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Actions\AHP\AnalyticalHierarchyProcessInstance $AHPAction
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function processSelection(Request $request, AnalyticalHierarchyProcessInstance $AHPAction): RedirectResponse
    {
        $this->flushEvaluationResults();

        $filters = null;

        $applicationDateRange = $request->input('application_date_range');
        $gender = $request->input('gender', 'all');

        if ($applicationDateRange) {
            $explode = explode(' - ', $applicationDateRange);
            $startDate = $explode[0];
            $endDate = $explode[1];

            $filters['start_date'] = $startDate;
            $filters['end_date'] = $endDate;
        }
        if ($gender !== 'all') {
            $filters['gender'] = $gender;
        }

        notify()->success(
            __('internship-applicant.notify.messages.process_selection.success'),
            __('internship-applicant.notify.title.success')
        );

        // Calculate AHP
        $isSuccess = $AHPAction->calculateAHP($filters);

        if ($isSuccess) {
            notify()->success(
                __('internship-applicant.notify.messages.process_selection.success'),
                __('internship-applicant.notify.title.success')
            );

            return redirect()->route('internship-applicants.applicant-selection-result', $filters);
        }

        notify()->error(
            __('internship-applicant.notify.messages.process_selection.error'),
            __('internship-applicant.notify.title.error')
        );

        return redirect()->back();
    }

    public function applicantSelectionResult(Request $request): View|RedirectResponse
    {
        $perPage = $request->query('perPage', 10);

        if ($this->fetchEvaluationResults()->count() > 0) {
            $applicationIds = $this->fetchEvaluationResults()->map(fn($item) => hashIdsDecode($item['application_id']))->toArray();
            $data['evaluation_results'] = Score::query()
                ->with('application.user', 'application.education')
                ->whereIn('application_id', $applicationIds)
                ->orderByDesc('final_score')
                ->paginate($perPage);
        } else {

            notify()->error(
                __('internship-applicant.notify.messages.process_selection.error'),
                __('internship-applicant.notify.title.error')
            );

            return redirect()->back();
        }


        return view('pages.internship-applicant.selection-result', compact('data'));
    }
}
