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
                'description' => 'required|string|max:550',
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
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images', $imageName, 'public');
                $validated['image'] = 'images/' . $imageName;
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

            $course = Course::with('chapters.topic')->find($id);
        

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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $validated['image'] = 'images/' . $imageName;

            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
        }

        $course->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Course updated successfully.',
            'data' => $course,
        ]);
    }

    public function destroy($courseId, $chapterId)
    {
        $course = Course::where('chapter_id', $chapterId)->where('id', $courseId)->first();

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully'], 200);
    }
}