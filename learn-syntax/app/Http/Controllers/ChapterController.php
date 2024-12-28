<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseId)
    {
        $chapter = Chapter::all();

        return response()->json([
            'status' => 200,
            'data' => $chapter
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'chapter_name' => 'required|string',
            'chapter_description' => 'required|string',
            'order' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }
        $validated = $validator->validated();
        $validated["chapter_slug"] = Str::slug($validated['chapter_name']);
        $chapter = Chapter::create($validated);
        return response()->json([
            'message' => 'Chapter Created Successfully',
            'chapter' => $chapter,

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $chapter = Chapter::with(['topics.post'])->find($id);

        if (!$chapter) {
            return response()->json([
                'message' => 'chapter not found',
            ], 404);
        }

        return response()->json([
            'message' => 'chapter Fetched Successfully',
            'data' => $chapter,
        ], 200);
    }

    // public function update(Request $request, $course_id, $chapter_id)
    // {

    //     dd($request->all());
    //     if (empty($request->all())) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'No data received.',
    //         ], 400);
    //     }

    //     $chapter = Chapter::where('course_id', $course_id)
    //         ->where('id',  $chapter_id)
    //         ->first();

    //     if (!$chapter) {
    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'Chapter not found.',
    //         ], 404);
    //     }

    //     $validatedData = $request->validate([
    //         'chapter_name' => 'sometimes|required|string',
    //         'chapter_description' => 'sometimes|required|string',
    //         'order' => 'sometimes|required|integer',
    //     ]);

    //     if (isset($validatedData['chapter_name'])) {
    //         $validatedData['chapter_slug'] = Str::slug($validatedData['chapter_name']);
    //     }

    //     $chapter->update($validatedData);

    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Chapter updated successfully.',
    //         'data' => $chapter,
    //     ]);
    // }

    public function update(Request $request, $course_id, $chapter_id)
    {
        
        $validatedData = $request->validate([
            'chapter_name' => 'required|string',
            'chapter_description' => 'required|string',
            'order' => 'required|integer',
        ]);

        $chapter = Chapter::where('course_id', $course_id)->where('id', $chapter_id)->first();

        if (!$chapter) {
            return response()->json(['message' => 'Chapter not found'], 404);
        }

        $chapter->update($validatedData);

        return response()->json(['message' => 'Chapter updated successfully', 'data' => $chapter], 200);
    }




    public function destroy($courseId, $chapterId)
    {
        $chapter = Chapter::where('course_id', $courseId)->where('id', $chapterId)->first();
        if (!$chapter) {
            return response()->json(['error' => 'Chapter not found'], 404);
        }
        $chapter->delete();
        return response()->json(['message' => 'Chapter deleted successfully.'], 200);
    }
}
