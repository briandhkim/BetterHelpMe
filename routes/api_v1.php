<?php

use App\Http\Controllers\Api\V1\ResultStatisticsController;
use App\Http\Controllers\Api\V1\SurveyAnswerController;
use App\Http\Controllers\Api\V1\SurveyController;
use App\Http\Controllers\Api\V1\SurveyResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function (Request $request) {
    return 'test abc';
});

Route::name('api.v1.')->group(function () {
    Route::resource('surveys', SurveyController::class)->only(['index']);

    Route::get('/surveys/{survey}/answer', SurveyAnswerController::class)->name('survey.answer');
    Route::get('/surveys{survey}/responses/received', [SurveyResponseController::class, 'received'])->name('survey.response.received');

    Route::post('/surveys/{survey}/responses', [SurveyResponseController::class, 'store']);

    Route::get('/surveys/{survey}/stats/{mood}', ResultStatisticsController::class);
});
