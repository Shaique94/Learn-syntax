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
  // Update a topic
public function update(Request $request, $chapterId, $topicId)
{
    // Fetch the topic based on chapter ID and topic ID
    $topic = Topic::where('chapter_id', $chapterId)->where('id', $topicId)->first();

    if (!$topic) {
        return response()->json([
            'status' => 404,
            'message' => 'Topic not found',
        ], 404);
    }

    // Validate and prepare data for update
    $validatedData = $request->validate([
        'chapter_id' => 'sometimes|required|integer',
        'topic_name' => 'sometimes|required|string',
        'topic_description' => 'sometimes|required|string',
        'order' => 'sometimes|required|integer',
    ]);

    // Add the topic slug if the topic name is being updated
    if (isset($validatedData['topic_name'])) {
        $validatedData['topic_slug'] = Str::slug($validatedData['topic_name']);
    }

    // Check if there's anything to update
    if (empty($validatedData)) {
        return response()->json([
            'status' => 400,
            'message' => 'No data provided to update the topic.',
        ], 400);
    }

    // Perform the update
    $topic->update($validatedData);

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
