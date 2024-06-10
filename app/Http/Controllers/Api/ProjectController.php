<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return response()->json([
            'success' => true,
            'results' => $projects,
            //dd($projects)
        ]);
    }

    public function Show($id)
    {
        $project = Project::where('id', $id)->first()->with('technologies', 'category')->get();
        
        return response()->json([
            'success' => true,
            'results' => $project,
        ]);
    }
}
