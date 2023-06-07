@extends('layouts.admin')


@section('content')
    <h1>Show projects table</h1>
    <a class="btn btn-dark" href="{{ route('admin.projects.create') }}" role="button">Create project</a>

    @include('partials.session_message')

    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless table-primary align-middle">
            <thead class="table-light">

                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Live Url</th>
                    <th scope="col">Src Code</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

                @forelse ($projects as $post)
                    <tr class="table-primary">
                        <td scope="row">{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td><img height="100" src="{{ $project->project_image }}" alt="{{ $project->title }}"></td>
                        <td>{{ $project->project_live_url }}</td>
                        <td>{{ $project->project_source_code }}</td>
                        <td>

                            <a href="{{ route('admin.projects.show', $project) }}" title="View"
                                class="text-decoration-none">
                                <i class="fas fa-eye fa-sm fa-fw"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" title="Edit"
                                class="text-decoration-none">
                                <i class="fas fa-pencil fa-sm fa-fw"></i>
                            </a>
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $project->slug }}">
                                <i class="fas fa-trash fa-sm fa-fw"></i>
                            </button>

                            <!-- Modal Body -->
                            <div class="modal fade" id="modal-{{ $project->slug }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modal-{{ $project->slug }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-{{ $project->slug }}">Delete
                                                {{ $project->title }} </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure?
                                        </div>
                                        <div class="modal-footer">

                                            <form action="{{ route('admin.projects.destroy', $project->slug) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">yes</button>
                                            </form>

                                            <button type="button" class="btn btn-secondary "
                                                data-bs-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="table-primary">
                        <td scope="row">No projects yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
