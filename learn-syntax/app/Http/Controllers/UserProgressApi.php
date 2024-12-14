<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProgressApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'course_id' => 'required',
            'score'=>'integer',
            'quiz_completed' => 'integer',
            'topic_completed' =>'integer',
            'chapter_completed' =>'integer',
            'course_completed' =>'integer',
         ]);
         if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
         }
         $validated = $validator->validated();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
