<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use App\Repositories\Api\V1\QuestionRepository;
use App\Repositories\Api\V1\SurveyRepository;
use App\Repositories\Contracts\ModelRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SurveyAnswerController extends Controller
{
    public function __construct(
        protected SurveyRepository $surveyRepository,
        protected QuestionRepository $questionRepository
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $survey_id)
    {
        $survey = $this->surveyRepository
            ->withRelationship(
                $this->findModelOrFail($survey_id, $this->surveyRepository),
                Question::class,
                'display_order asc, title asc'
            );

        $survey->questions->map(function ($question) {
            $this->questionRepository->withRelationship($question, Choice::class);
        });

        return Inertia::render('Survey/Answer/AnswerIndex', [
            'pageTitle' => $survey->title,
            // 'survey' => $survey->load('questions.choices'),
            'survey' => $survey,
        ]);
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
