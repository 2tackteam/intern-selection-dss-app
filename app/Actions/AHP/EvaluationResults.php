<?php

namespace App\Actions\AHP;

use App\Models\Score;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait EvaluationResults
{
    /**
     * @throws \Throwable
     */
    public function captureFinalResults(Collection $evaluationResults): Collection
    {
        DB::transaction(function () use ($evaluationResults) {
            foreach ($evaluationResults as $result) {
                Score::create([
                    'application_id' => hashIdsDecode($result['application_id']),
                    'final_score'    => $result['final_score'],
                ]);

                // Update application status to 'accepted'
                //Application::where('id', $result->application_id)->update(['status' => 'accepted']);
            }
        });

        request()
            ->session()
            ->put('evaluation_results', $evaluationResults);

        return $evaluationResults;
    }

    public function fetchEvaluationResults(): Collection
    {
        $session = request()->session();

        $collection = collect();

        if ($session->has('evaluation_results')) {
            $collection = $collection->merge($session->get('evaluation_results'));
        }

        return $collection;
    }

    /**
     * @throws \Throwable
     */
    public function clearEvaluationResults(): void
    {
        $session = request()->session();

        if ($session->has('evaluation_results')) {
            $evaluationResults = $session->get('evaluation_results');

            DB::transaction(function () use ($evaluationResults) {
                foreach ($evaluationResults as $result) {
                    Score::query()
                        ->where('application_id', '=', hashIdsDecode($result['application_id']))
                        ->delete();
                }
            });

            $this->flushSessionEvaluationResults();
        }
    }

    public function flushSessionEvaluationResults(): void
    {
        $session = request()->session();
        if ($session->has('evaluation_results')) {
            $session->forget('evaluation_results');
        }
    }
}
