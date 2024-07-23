<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
}
