<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatusEnum;
use App\Exports\InternshipApplicantSelectionResultExport;
use App\Models\Application;
use App\Models\Score;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InternshipApplicationSelectionResultController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:view internship-applicant-selection-results', only: ['index']),
            new Middleware('can:print internship-applicant-selection-results', only: ['index']),
        ];
    }

    public function index(Request $request): View
    {
        $perPage           = $request->query('perPage', 10);
        $applicationStatus = $request->query('application_status');

        $data['selection_results'] = Score::query()
            ->with('application.user', 'application.education')
            ->when($applicationStatus !== null && $applicationStatus !== 'all', function (Builder $query) use ($applicationStatus) {
                $query->whereRelation('application', 'status', '=', $applicationStatus);
            })
            ->orderByDesc('final_score')
            ->paginate($perPage);

        return view('pages.internship-applicant-selection-result.index', compact('data'));
    }

    public function print(Request $request): BinaryFileResponse|RedirectResponse
    {
        $applications = Application::query()
            ->with('user', 'score', 'education')
            ->has('score')
            ->whereNot('status', '=', ApplicationStatusEnum::PENDING->value)
            ->get();

        if ($applications->isEmpty()) {
            notify()->info(
                __('internship-applicant-selection-result.notify.messages.export.empty'),
                __('internship-applicant-selection-result.notify.title.info')
            );

            return redirect()->back();
        }

        $time = now()->format('YmdHis');

        notify()->success(
            __('internship-applicant-selection-result.notify.messages.export.success'),
            __('internship-applicant-selection-result.notify.title.success')
        );

        return Excel::download(new InternshipApplicantSelectionResultExport($applications), 'internship-applicant-' . $time . '.xlsx');
    }
}
