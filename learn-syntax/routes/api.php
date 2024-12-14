<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\CourseController;


use App\Http\Controllers\ChapterController;

use App\Http\Controllers\TopicApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
   // return $request->user();
//})->middleware('auth:sanctum');

Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout']);


Route::apiResource('courses',CourseController::class);


Route::get('courses/{courseId}/chapters/{chapterId}/show', [ChapterController::class, 'show']);
Route::post('courses/{courseId}/chapters', [ChapterController::class, 'store']);
Route::put('courses/{courseId}/chapters', [ChapterController::class, 'update']);
Route::delete('courses/{courseId}/chapters', [ChapterController::class, 'destroy']);



//Routes for topic
Route::post('chapters/{chapterId}/topics', [TopicApiController::class, 'store']);
Route::put('chapters/{chapterId}/topics/{topicId}', [TopicApiController::class, 'update']);
Route::delete('chapters/{chapterId}/topics/{topicId}', [TopicApiController::class, 'destroy']);
