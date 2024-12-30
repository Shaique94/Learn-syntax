<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostContentApiController extends Controller
{

    //currently we are not using this show function because on admin side we don't need it
    public function show($topic_id, $post_id)
    {
        try {
            // Find the post by its ID and ensure it belongs to the specified topic
            $post = Post::where('id', $post_id)
                ->where('topic_id', $topic_id)
                ->first();

            // If post is not found, return a 404 response
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found or does not belong to this topic.'
                ], 404);
            }

            // Return the post data
            return response()->json([
                'success' => true,
                'data' => $post
            ], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching the post details.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $topic_id, $post_id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // Optional image upload
        ]);

        try {
            // Find the post
            $post = Post::where('id', $post_id)
                ->where('topic_id', $topic_id)
                ->first();

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found or does not belong to this topic.'
                ], 404);
            }

            // Update fields
            $post->title = $validatedData['title'];
            $post->content = $validatedData['content'];

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete the old image
                if ($post->image && file_exists(storage_path('app/public/post/' . $post->image))) {
                    unlink(storage_path('app/public/post/' . $post->image));
                }

                // Save the new image
                $imagePath = $request->file('image')->store('post', 'public');
                $post->image = basename($imagePath);
            }

            $post->save();

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully.',
                'data' => $post
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the post.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($topic_id, $post_id)
    {
        try {
            // Find the post
            $post = Post::where('id', $post_id)
                ->where('topic_id', $topic_id)
                ->first();

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found or does not belong to this topic.'
                ], 404);
            }

            // Delete the associated image if it exists
            if ($post->image && file_exists(storage_path('app/public/post/' . $post->image))) {
                unlink(storage_path('app/public/post/' . $post->image));
            }

            // Delete the post
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the post.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
