<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(6);

        return response()->json([
            'success' => true,
            'projects' =>  $projects,
        ]);
    }
    public function show($slug) {
        $project = Project::with(['type', 'technologies', 'user'])-where('slug', $slug)->first();
        // dd($project);
        if($project) {
            return response()->json([
                'success' => true,
                'result' =>  $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' =>  'Project not found 404',
            ]);
        }
    }
}