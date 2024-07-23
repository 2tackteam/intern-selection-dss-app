<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationSubmissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
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

        $data['applications'] = Auth::user()->applicants()->paginate($perPage);

        return view('pages.application-submission.index', compact('data'));
    }

    public function create(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applications'] = Auth::user()->applicants()->paginate($perPage);

        return view('pages.application-submission.create', compact('data'));
    }

    public function store(StoreApplicationSubmissionRequest $request): RedirectResponse
    {
        return redirect()->route('application-submissions.index');
    }

    public function show(string $hashedId): View
    {
        $data['application'] = Auth::user()->applicants()->where('id', hashIdsDecode($hashedId))->firstOrFail();

        return view('pages.application-submission.show', compact('data'));
    }

    public function print(string $hashedId): View
    {
        $data['application'] = Auth::user()->applicants()->where('id', hashIdsDecode($hashedId))->firstOrFail();

        return view('pages.application-submission.print', compact('data'));
    }
}
