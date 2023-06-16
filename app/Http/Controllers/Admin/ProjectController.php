<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        $projects = Auth::user()->projects()->orderByDesc("id")->paginate(8);
        return view('admin.projects.index', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::orderByDesc('id')->get();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->all());
        $val_data = $request->validated();
        // dd($val_data);

        $slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $slug;

        $val_data['user_id'] = Auth::id();
        // dd($val_data);

        if ($request->hasFile('project_image')) {
            $image_path = Storage::put('uploads', $request->project_image);
            // dd($image_path);
            $val_data['project_image'] = $image_path;
            // dd($val_data);
        }

        $new_project = Project::create($val_data);

        if ($request->has('technologies')) {
            $new_project->technologies()->attach($request->technologies);
        }

        return to_route('admin.projects.index')->with('message', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::orderByDesc('id')->get();
        $types = Type::orderByDesc('id')->get();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));

        if (Auth::id() === $project->user_id) {
            return view('admin.projects.edit', compact('project', 'types', 'technologies'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();
        $slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $slug;

        if ($request->hasFile('project_image')) {
            //dd('here');

            //if project->project_image
            // delete the previous image

            if ($project->project_image) {
                Storage::delete($project->project_image);
            }

            // Save the file in the storage and get its path
            $image_path = Storage::put('uploads', $request->project_image);
            //dd($image_path);
            $val_data['project_image'] = $image_path;
        }

        $project->update($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return to_route('admin.projects.index')->with('message', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // remove the image from the storage
        if ($project->project_image) {
            Storage::delete($project->project_image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully!');
    }
}
