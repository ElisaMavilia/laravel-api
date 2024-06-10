<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::paginate(5); //quando si inserisce la paginazione i projects sono inseriti dentro la chiave "data". Senza la paginazione i dati si trovano direttamente dentro results
        return response()->json([
            'success' => true,
            'results' => $projects,
            //dd($projects)
        ]);
    }

    public function Show($slug)
    {
        $project = Project::where('slug', $slug)->with('technologies', 'category')->first();
        if ($project){ //inserire controllo per verificare che il project esista
            return response()->json([
                'success' => true,
                'results' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false, //se il project non esiste restituisce un errore e success = false
                'results' => 'Project not found',
            ]);
        }
        
        
    }
}
