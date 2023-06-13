@extends('layouts.admin')


@section('content')
    <h1 class="text-muted display-5 py-3">Technologies Page</h1>

    @include('partials.validation_errors')
    @include('partials.session_message')
    <div class="row">

        <div>

            <div class="table-responsive-md">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($technologies as $technology)
                            <tr class="">
                                <td scope="row">{{ $technology->id }}</td>
                                <td>
                                    <form action="{{ route('admin.technologies.store') }}" method="POST">
                                        @csrf

                                        <input type="text" name="name" id="name"
                                            class="form-control border-0 bg-transparent" value="{{ $technology->name }}"
                                            aria-describedby="editInput-{{ $technology->id }}">
                                        <span class="input-group-text border-0"><i class="fa-regular fa-pencil"
                                                id="editInput-{{ $technology->id }}"></i></span>
                                    </form>
                                    <small>Press enter to update the technology name</small>
                                </td>
                                <td><img src="{{ $technology->image }}" width="200" alt="{{ $technology->name }}"></td>
                                <td>{{ $technology->name }}</td>
                                <td>{{ $technology->slug }}</td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button technology="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $technology->slug }}">
                                        <i class="fas fa-trash fa-sm fa-fw"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <div class="modal fade" id="modal-{{ $technology->slug }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modal-{{ $technology->slug }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-{{ $technology->slug }}">Delete
                                                        {{ $technology->title }} </h5>
                                                    <button technology="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure?
                                                </div>
                                                <div class="modal-footer">

                                                    <form
                                                        action="{{ route('admin.technologies.destroy', $technology->slug) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button technology="submit" class="btn btn-danger">yes</button>
                                                    </form>

                                                    <button technology="button" class="btn btn-secondary "
                                                        data-bs-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td scope="row">Add a technology</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div>
                    <form action="{{ route('admin.technologies.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input technology="text" class="form-control" placeholder="Full Stack" aria-label="Button"
                                name="name" id="name">
                            <button class="btn btn-outline-secondary" technology="submit">Add</button>
                        </div>

                    </form>
                </div>

            </div>


        </div>

    </div>
@endsection
