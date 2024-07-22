<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InternshipApplicantController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = $request->query('perPage', 10);

        $data = [
            'applicants' => Application::query()->with('user', 'education')->paginate($perPage),
        ];

        return view('internship-applicant.index', compact('data'));
    }

    public function create(): View
    {
        return view('internship-applicant.create');
    }
}
