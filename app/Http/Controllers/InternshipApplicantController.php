<?php

namespace App\Http\Controllers;

use App\Actions\AHP\EvaluationResults;
use App\Enums\ApplicationStatusEnum;
use App\Models\Application;
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
            new Middleware('can:view internship-applicants', only: ['index', 'show']),
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
            ->whereIn('status', array_slice(ApplicationStatusEnum::toArray(), 1, 3))
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

        return view('pages.print.print-page', compact('data'));
    }
}
