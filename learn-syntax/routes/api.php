<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExecuteController;
use App\Http\Controllers\PostApiController;
use App\Http\Controllers\PostContentApiController;
use App\Http\Controllers\TopicApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route for authenticated user
Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:api')->put('/user', [AuthController::class, 'user']);

// Authentication routes
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/google-login', [AuthController::class, 'googleLogin']);
Route::post('auth/logout', [AuthController::class, 'logout']);

// Course routes
Route::apiResource('courses', CourseController::class);
Route::get('courses/{courseId}/show', [CourseController::class, 'show']);
Route::get('courses/{course_id}', [CourseController::class, 'index']);

// Chapter routes
Route::apiResource('chapters', ChapterController::class);
Route::get('chapters/{chapterId}/show', [ChapterController::class, 'show']);
Route::get('chapters/{chapter_id}', [ChapterController::class, 'index']);
Route::put('courses/{course_id}/chapters/{chapter_id}', [ChapterController::class, 'update']);
Route::delete('/{chapterId}',[ChapterController::class,'destroy']);


Route::put('courses/{course_id}/chapters/{chapter_id}', [ChapterController::class, 'update']);
// Topic routes
Route::post('chapters/{chapterId}/topics', [TopicApiController::class, 'store']);
Route::put('chapters/{chapterId}/topics/{topicId}', [TopicApiController::class, 'update']);
Route::delete('chapters/{chapterId}/topics/{topicId}', [TopicApiController::class, 'destroy']);
Route::get('chapters/{chapterId}/topics/{topicId}/show', [TopicApiController::class, 'show']);
Route::get('chapters/{chapterId}/topics', [TopicApiController::class, 'index']);

// Dashboard data route
Route::get('/dashboard-count', [DashboardController::class, 'getData']);

// Post routes under a topic
Route::prefix('topics/{topicId}')->group(function () {
   Route::get('/post', [PostApiController::class, 'show']); // Get the post for a specific topic
   Route::post('/post', [PostApiController::class, 'store']); // Create a new post for a specific topic
   Route::put('/post/{postId}', [PostApiController::class, 'update']); // Update the post for a specific topic
   Route::delete('/post', [PostApiController::class, 'destroy']); // Delete the post for a specific topic
   // Route::get('/post',[PostApiController::class,'index']);
   Route::get('/drafts', [PostApiController::class, 'getDrafts']); // Get drafts for a specific topic

});
Route::prefix('topics/{topic_id}/posts')->group(function () {
   // Get all posts for a topic
   // Route::get('/', [PostContentApiController::class, 'index']);  
   // Get a single post by its ID
   Route::get('/{post_id}', [PostContentApiController::class, 'show']); 
   // Create a new post for a topic
   Route::post('/', [PostContentApiController::class, 'store']); 
   // Update a specific post in a topic
   Route::put('/{post_id}', [PostContentApiController::class, 'update']); 
   // Delete a specific post in a topic
   Route::delete('/{post_id}', [PostContentApiController::class, 'destroy']);
});
//Route for contact us page
Route::post('contact',[ContactController::class,'submit']);

Route::middleware([])->group(function () {
   Route::post('/v2/execute', [ExecuteController::class, 'execute']);
});
