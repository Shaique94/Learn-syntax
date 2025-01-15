<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();

        return response()->json([
            'status' => 200,
            'data' => $course,
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $validated = $validator->validated();
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $filePath;
        } else {
            $validated['image'] = 'icons/default-icon.png'; // Default icon path
        }

       


        $validated['course_slug'] = Str::slug($validated['title']);

        $course = Course::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Course created successfully.',
            'data' => $course,
        ], 201);
    }

    public function show($id)
    {

        $course = Course::with('chapters.topics.post')->find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Course Fetched Successfully',
            'data' => $course,
        ], 200);
    }


    public function update(Request $request, string  $id)
    {
        $course = Course::where('id', $id)->first();


        if (!$course) {
            return response()->json([
                'status' => 404,
                'message' => 'Course not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:550',
            'image' => 'sometimes|required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $validated = $validator->validated();

        if ($request->has('title')) {
            $validated['course_slug'] = Str::slug($validated['title']);
        }

        if ($request->has('image')) {
            $validated['image'] = $request->input('image'); // Use the input directly
        }

        $course->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Course updated successfully.',
            'data' => $course,
        ]);
    }

    public function destroy($courseId)
    {
        // Attempt to find the course based on courseId and chapterId
        $course = Course::where('id', $courseId)->first();
    
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }
    
        // Delete the course
        $course->delete();
    
        return response()->json(['message' => 'Course deleted successfully'], 200);
    }
    
}
