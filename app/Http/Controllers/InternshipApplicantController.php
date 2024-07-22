<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Education;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InternshipApplicantController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()->with('user', 'education')->latest()->paginate($perPage);

        return view('internship-applicant.index', compact('data'));
    }

    public function show(string $hashedId): View
    {
        $data['application'] = Application::query()->with('user', 'education')->find(hashIdsDecode($hashedId));

        return view('internship-applicant.show', compact('data'));
    }

    public function print(string $hashedId): View
    {
        $data['application'] = Application::query()->with('user', 'education')->find(hashIdsDecode($hashedId));

        return view('internship-applicant.print', compact('data'));
    }

    public function applicantSelection(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data['applicants'] = Application::query()->with('user', 'education')
            ->latest('id')
            ->paginate($perPage);

        return view('internship-applicant.selection', compact('data'));
    }
}
