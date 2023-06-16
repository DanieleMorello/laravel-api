<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Auth::user()->technologies()->orderByDesc("id")->paginate(8);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        // dd($request->all());
        $val_data = $request->validated();
        // dd($val_data);

        $slug = Technology::generateSlug($val_data['name']);
        $val_data['slug'] = $slug;

        $val_data['user_id'] = Auth::id();
        // dd($val_data);

        if ($request->hasFile('technology_image')) {
            $image_path = Storage::put('uploads', $request->technology_image);
            // dd($image_path);
            $val_data['technology_image'] = $image_path;
            // dd($val_data);
        }
        $new_technology = Technology::create($val_data);

        // if ($request->has('technologies')) {
        //     $new_technology->technologies()->attach($request->technologies);
        // }

        return to_route('admin.technologies.index')->with('message', 'technology created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->validated();
        $slug = Technology::generateSlug($val_data['name']);
        $val_data['slug'] = $slug;

        if ($request->hasFile('technology_image')) {
            //dd('here');

            //if technology->technology_image
            // delete the previous image

            if ($technology->technology_image) {
                Storage::delete($technology->technology_image);
            }

            // Save the file in the storage and get its path
            $image_path = Storage::put('uploads', $request->technology_image);
            //dd($image_path);
            $val_data['technology_image'] = $image_path;
        }

        $technology->update($val_data);

        if ($request->has('technologies')) {
            $technology->technologies()->sync($request->technologies);
        }

        return to_route('admin.technologies.index')->with('message', 'Technology updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', 'Technology delete successfully');
    }
}