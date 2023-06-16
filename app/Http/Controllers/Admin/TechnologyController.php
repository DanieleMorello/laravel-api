<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        // dd($request);
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name);
        Technology::create($val_data);
        return to_route('admin.technologies.index')->with('message', 'Technology created successfully');
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
        // dd($request->all());
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name);
        $technology->update($val_data);
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
