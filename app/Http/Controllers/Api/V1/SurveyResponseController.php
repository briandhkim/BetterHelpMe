<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Api\V1\AnswerRepository;
use App\Repositories\Api\V1\ResponseRepository;
use App\Repositories\Api\V1\SurveyRepository;
use App\Repositories\Contracts\ModelRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SurveyResponseController extends Controller
{
    public function __construct(
        protected SurveyRepository $surveyRepository,
        protected ResponseRepository $responseRepository,
        protected AnswerRepository $answerRepository
    ) {}

    public function received(string $survey_id)
    {
        $survey = $this->findModelOrFail($survey_id, $this->surveyRepository);

        return Inertia::render('Survey/Answer/AnswerReceived', [
            'pageTitle' => 'Response submitted',
            'survey' => $survey,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $survey_id)
    {
        $survey = $this->findModelOrFail($survey_id, $this->surveyRepository);

        $validationRules = $survey->questions
            ->map(function ($question) {
                return ["question_$question->id" => 'required|array'];
            })->mapWithKeys(function ($questionRule) {
                return $questionRule;
            })->toArray();

        $validated = collect($request->validate($validationRules));

        $response = $this->responseRepository->create(['survey_id' => $survey->id]);

        $validated->map(function ($answers, $question) use ($response) {
            $questionId = (int) str_replace('question_', '', $question);

            collect($answers)->map(function ($answer) use ($response, $questionId) {
                $this->answerRepository
                    ->create([
                        'question_id' => $questionId,
                        'response_id' => $response->id,
                        'input' => $answer,
                    ]);
            });
        });

        return to_route('api.v1.survey.response.received', ['survey' => $survey]);
    }

    private function findModelOrFail(string $id, ModelRepository $repository)
    {
        $model = $repository->find($id);

        if (empty($model)) {
            throw new ModelNotFoundException;
        }

        return $model;
    }
}
