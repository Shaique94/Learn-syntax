<?php

namespace App\Http\Controllers;
use App\Models\Course; 
use App\Models\Chapter; 
use App\Models\Topic; 

class DashboardController extends Controller
{
    public function getData()
    {
        try {
           
            $totalCourses = Course::count();
            $totalChapters = Chapter::count();
            $totalTopics = Topic::count();

           
            return response()->json([
                'success' => true,
                'data' => [
                    'totalCourses' => $totalCourses,
                    'totalChapters' => $totalChapters,
                    'totalTopics' => $totalTopics,
                ],
            ], 200);
        } catch (\Exception $e) {
           
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
