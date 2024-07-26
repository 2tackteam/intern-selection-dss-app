<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationSubmissions\StoreApplicationSubmissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ApplicationSubmissionController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:view applications', only: ['index', 'show', 'print']),
            new Middleware('can:create applications', only: ['create', 'store']),
            new Middleware('can:print applications', only: ['print']),
        ];
    }

    public function index(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applications'] = Auth::user()->applications()->paginate($perPage);
        $data['applicationExists'] = Auth::user()->applications()->exists();

        return view('pages.application-submission.index', compact('data'));
    }

    public function create(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applications'] = Auth::user()->applications()->paginate($perPage);

        return view('pages.application-submission.create', compact('data'));
    }

    public function store(StoreApplicationSubmissionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data) {
                $application = Auth::user()->applications()->create([
                    'full_name' => $data['full_name'],
                    'birth_place' => $data['birth_place'],
                    'birth_date' => $data['birth_date'],
                    'gender' => $data['gender'],
                ]);

                $application->education()->create([
                    'education_level' => $data['education_level'],
                    'institution_name' => $data['institution_name'],
                    'major' => $data['major'],
                    'start_year' => $data['start_year'],
                    'end_year' => $data['end_year'],
                    'gpa' => $data['gpa'],
                ]);
            });

            notify()->success(
                __('application-submission.notify.messages.store.success'),
                __('application-submission.notify.title.success')
            );

            return redirect()->route('application-submissions.index');
        } catch (\Throwable $throwable) {

            notify()->error(
                __('application-submission.notify.messages.store.error'),
                __('application-submission.notify.title.error')
            );

            return redirect()->back()->withInput($request->all());
        }
    }

    public function show(string $hashedId): View
    {
        $data['application'] = Auth::user()->applications()->where('id', hashIdsDecode($hashedId))->firstOrFail();

        return view('pages.application-submission.show', compact('data'));
    }

    public function print(string $hashedId): View
    {
        $data['application'] = Auth::user()->applications()->where('id', hashIdsDecode($hashedId))->firstOrFail();

        return view('pages.application-submission.print', compact('data'));
    }
}
