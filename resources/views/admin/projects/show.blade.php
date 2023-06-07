@extends('layouts.admin')

@section('content')
    <section>
        <div class="container py-5">
            <h3 class="pb-4">Title: {{ $project->title }}</h3>
            <div class="content_container d-flex">
                <div class="project_img_container">
                    <img src="{{ $project->project_image }}" alt="{{ $project->title }}" height="300">
                </div>
                <div class="project_info ps-4">
                    <p><strong>Description:</strong><br>{{ $project->description }}</p>
                    <span class="d-block"><strong>Link: </strong>{{ $project->project_url }}</span>
                </div>
            </div>
        </div>
    </section>
@endsection
