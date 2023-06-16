@extends('layouts.admin')


@section('content')
    <h1 class="py-3">Add a new Technology</h1>


    @include('partials.validation_errors')

    <form action="{{ route('admin.technologies.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Technology</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                aria-describedby="nameHelper" placeholder="Type your technology name here..." value="{{ old('name') }}">
            <small id="nameHelper" class="form-text text-muted">Type the technology name max 150 characters - must be
                unique</small>
            @error('name')
                <div class="alert alert-danger" role="alert">
                    <strong>name, Error: </strong>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="technology_image" class="form-label">Image</label>
            <input type="file" class="form-control @error('technology_image') is-invalid @enderror"
                name="technology_image" id="technology_image" aria-describedby="technology_imageHelper"
                placeholder="Type your technology Image here..." value="{{ old('technology_image') }}">
            <small id="technology_imageHelper" class="form-text text-muted">Type the technology image max 955
                characters</small>
            @error('technology_image')
                <div class="alert alert-danger" role="alert">
                    <strong>Image, Error: </strong>{{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">Save</button>

    </form>
@endsection
