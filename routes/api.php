<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LessonAPIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get(
    '/get-data', 
    [LessonAPIController::class, 'getData']
);

Route::middleware('auth:sanctum')->post(
    '/save-mark', 
    [LessonAPIController::class, 'saveMark']
);