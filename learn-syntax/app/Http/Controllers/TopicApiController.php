<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TopicApiController extends Controller
{
    public function store(Request $request, $chapterId)
    {   
        
        $validatedData = $request->validate([
            'topic_name' => 'required|string|max:255', 
            'topic_description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);
       
        
        // Create the topic
        if( $validatedData){
            $topic = new Topic();
            $topic->chapter_id = $chapterId;
            $topic->topic_name = $validatedData['topic_name'];
            $topic->topic_description = $validatedData['topic_description'];
            $topic->order = $validatedData['order'] ?? 0;
            $topic->topic_slug = Str::slug($validatedData['topic_name']);
            $topic->save();
            
        }
        return response()->json(['message' => 'Topic added', 'topic' => $topic], 201);
    }

    // Update a topic
    public function update(Request $request,  $chapterId,$topicId)
    {
        if (empty($request->all())) {
            return response()->json([
                'status' => 400,
                'message' => 'No data received. Ensure you are sending data correctly.',
            ], 400);
        }

        $topic = Topic::where('chapter_id', $chapterId)->where('id', $topicId)->first();

        $validatedData = [];

        if ($request->has('chapter_id')) {
            $validator = Validator::make($request->only('chapter_id'), [
                'chapter_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ], 422);
            }

            $validatedData['chapter_id'] = $request->input('chapter_id');
        }

        if ($request->has('topic_name')) {
            $validator = Validator::make($request->only('topic_name'), [
                'topic_name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ], 422);
            }

            $topic_name = $request->input('topic_name');
            $validatedData['topic_name'] = $topic_name;
            $validatedData['topic_slug'] = Str::slug($topic_name);
        }

        if ($request->has('topic_description')) {
            $validator = Validator::make($request->only('topic_description'), [
                'topic_description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ], 422);
            }

            $validatedData['topic_description'] = $request->input('topic_description');
        }

        if ($request->has('order')) {
            $validator = Validator::make($request->only('order'), [
                'order' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ], 422);
            }

            $validatedData['order'] = $request->input('order');
        }

        if (!empty($validatedData)) {
            $topic->update($validatedData);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Topic updated successfully',
            'data' => $topic,
        ]);
    }

    //Showing  a specific topic
    public function show($chapterId, $topicId){
        $topic = Topic::where('chapter_id', $chapterId)->where('id', $topicId)->first();
        if(!$topic){
            return response()->json([
                'status' => 404,
                'message' =>'topic not Found',

            ],404);
        }
        return response()->json([
            'status' =>200,
            'data'=>$topic,
        ]);
    }

    //Showing every topic of chapter
    public function index($chapterId){
        $topics = Topic::where('chapter_id', $chapterId)->orderBy('order', 'asc')->get();

        // Check if any topics are found
    if ($topics->isEmpty()) {
        return response()->json([
            'status' => 404,
            'message' => 'No topics found for this chapter',
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'data' => $topics,
    ], 200);
    }

     // Delete a topic
    public function destroy($chapterId, $topicId)
    {
        $topic = Topic::where('chapter_id', $chapterId)->where('id', $topicId)->first();

        if (!$topic) {
            return response()->json(['error' => 'Topic not found'], 404);
        }

        $topic->delete();

        return response()->json(['message' => 'Topic deleted successfully'], 200);
    }
}
