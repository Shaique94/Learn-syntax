<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
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
     public function update(Request $request, $chapterId, $topicId)
     {
         $topic = Topic::where('chapter_id', $chapterId)->where('id', $topicId)->first();
 
         if (!$topic) {
             return response()->json(['error' => 'Topic not found'], 404);
         }
 
         $validatedData = $request->validate([
             'topic_name' => 'sometimes|string|max:255',
             'topic_description' => 'nullable|string',
             'order' => 'nullable|integer',
         ]);
 
         if (isset($validatedData['topic_name'])) {
             $topic->topic_name = $validatedData['topic_name'];
             $topic->topic_slug = Str::slug($validatedData['topic_name']);
         }
 
         if (isset($validatedData['topic_description'])) {
             $topic->topic_description = $validatedData['topic_description'];
         }
 
         if (isset($validatedData['order'])) {
             $topic->order = $validatedData['order'];
         }
 
         $topic->save();
 
         return response()->json(['message' => 'Topic updated successfully', 'topic' => $topic], 200);
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
