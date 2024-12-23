<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostApiController;
use App\Http\Controllers\TopicApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
   // return $request->user();
//})->middleware('auth:sanctum');

Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:api')->put('/user', [AuthController::class, 'user']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout']);
Route::apiResource('courses',CourseController::class);
Route::apiResource('chapters',ChapterController::class);
Route::get('courses/{courseId}/show',[CourseController::class,'show']);
Route::get('courses/{course_id}', [CourseController::class, 'index']);
//Routes for chapter
Route::get('chapters/{chapterId}/show',[ChapterController::class,'show']);
Route::get('chapters/{chapter_id}',[ChapterController::class,'index']);
//Routes for topic
Route::post('chapters/{chapterId}/topics', [TopicApiController::class, 'store']);
Route::put('chapters/{chapterId}/topics/{topicId}', [TopicApiController::class, 'update']);
Route::delete('chapters/{chapterId}/topics/{topicId}', [TopicApiController::class, 'destroy']);
//below route will be for only specific chapter's topic
Route::get('chapters/{chapterId}/topics/{topicId}/show', [TopicApiController::class, 'show']);
//below route will show all the topics of particular chapter
Route::get('chapters/{chapterId}/topics', [TopicApiController::class, 'index']);
Route::get('/dashboard-count', [DashboardController::class, 'getData']);
//Routes for the post 
Route::prefix('topics/{topicId}')->group(function () {
   Route::get('/post', [PostApiController::class, 'show']); // Get the post for a specific topic
   Route::post('/post', [PostApiController::class, 'store']); // Create a new post for a specific topic
   Route::put('/post', [PostApiController::class, 'update']); // Update the post for a specific topic
   Route::delete('/post', [PostApiController::class, 'destroy']); // Delete the post for a specific topic
   Route::get('/topics/{topicId}/drafts', [PostApiController::class, 'getDrafts']);

});


