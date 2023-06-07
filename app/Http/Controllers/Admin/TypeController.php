<?php

namespace App\Http\Controllers\Admin;

use App\Models\type;
use App\Http\Requests\StoretypeRequest;
use App\Http\Requests\UpdatetypeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->get();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretypeRequest $request)
    {
        //dd($request->all());

        $val_data = $request->validated();

        $slug = Str::slug($request->name);
        //dd($slug);
        $val_data['slug'] = $slug;

        Type::create($val_data);
        return to_route('admin.types.index')->with('message', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetypeRequest  $request
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetypeRequest $request, type $type)
    {
        //dd($request);
        $val_data = $request->validated();
        $val_data['slug'] = Type::generateSlug($val_data["name"]);
        //dd($val_data);
        $type->update($val_data);
        return to_route('admin.types.index')->with('message', 'type add successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', 'Type deleted successfully');
    }
}