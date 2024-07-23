<?php

namespace App\Http\Controllers;

use App\Actions\AHP\AnalyticalHierarchyProcessAction;
use App\Models\Application;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class InternshipApplicantController extends Controller implements HasMiddleware
{
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

    public function index(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()->with('user', 'education')->latest()->paginate($perPage);

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

    public function applicantSelection(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()->with('user', 'education')
            ->latest('id')
            ->paginate($perPage);

        return view('pages.internship-applicant.selection', compact('data'));
    }

    public function processSelection(Request $request, AnalyticalHierarchyProcessAction $action): RedirectResponse
    {
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
        $results = $action->calculateAHP($filters);

        if ($results && isset($results['status'], $results['evaluation_results']) && is_countable($results['evaluation_results'])) {
            notify()->success(
                __('internship-applicant.notify.messages.process_selection.success'),
                __('internship-applicant.notify.title.success')
            );

            $request->session()->put('results', $results);

            return redirect()->route('internship-applicants.applicant-selection-result', $filters);
        }

        notify()->error(
            __('internship-applicant.notify.messages.process_selection.error'),
            __('internship-applicant.notify.title.error')
        );

        return redirect()->back();
    }

    public function applicantSelectionResult(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $applicationIds = Score::query()->with('application')->orderBy('final_score', 'desc')->pluck('application_id');

        $data['applicants'] = Application::query()->with('user', 'education')
            ->whereIn('id', $applicationIds)
            ->paginate($perPage);

        return view('pages.internship-applicant.selection-result', compact('data'));
    }
}
