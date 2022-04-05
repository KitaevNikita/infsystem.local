<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LessonAPIController;
use App\Http\Controllers\API\SummaryListAPIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get(
    '/lesson/get-data', 
    [LessonAPIController::class, 'getData']
);

Route::middleware('auth:sanctum')->post(
    '/lesson/save-mark', 
    [LessonAPIController::class, 'saveMark']
);

Route::middleware('auth:sanctum')->get(
    '/summary-list/get-data', 
    [SummaryListAPIController::class, 'getData']
);
