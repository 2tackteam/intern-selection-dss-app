<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationSubmissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationSubmissionController extends Controller
{
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
