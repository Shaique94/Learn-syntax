<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostApiController extends Controller
{
    public function index($topic_id)
    {
        $post = Post::where('topic_id',$topic_id)->get();

        return response()->json([
            'status' => 200,
            'data' => $post,
        ]);
    }


   
    // For displaying specified post 
    public function show($topic_id)
    {

        $post = Post::where('topic_id', $topic_id)->get();
        if (!$post) {
            return response()->json(['message' => 'Posts not found']);
        } else {
            return response()->json(['post' => $post]);
        }
    }
    //for storing the post
    public function store(Request $request, $topicId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $topic = Topic::findOrFail($topicId);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'topic_id' => $topic->id,
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'status' => $request->status ?? false
            ]);

        return response()->json(['message' => 'Post created successfully.', 'post' => $post], 201);
    }

    //for updating the post
    public function update(Request $request, $topic_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $post = Post::where('topic_id', $topic_id)->first();
        if (!$post) {
            return response()->json(['message' => 'Post not found for the specified topic.'], 404);
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->update(['image_path' => $imagePath]);
        }
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Post updated successfully.', 'post' => $post], 200);
    }
    //for deleting the post
    public function destroy($topic_id)
    {
        $post = Post::where('topic_id', $topic_id)->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found for the specified topic.'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully.'], 200);
    }
}
