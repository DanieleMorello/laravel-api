@extends('layouts.admin')


@section('content')
    <h1 class="text-muted display-5 py-3">Types Page</h1>

    @include('partials.validation_errors')
    @include('partials.session_message')
    <div class="row">

        <div>

            <div class="table-responsive-md">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Projects Count</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($types as $type)
                            <tr class="">
                                <td scope="row">{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->slug }}</td>
                                <td>
                                    <span class="badge bg-dark">{{ $type->projects->count() }}</span>

                                </td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $type->slug }}">
                                        <i class="fas fa-trash fa-sm fa-fw"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <div class="modal fade" id="modal-{{ $type->slug }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modal-{{ $type->slug }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-{{ $type->slug }}">Delete
                                                        {{ $type->title }} </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure?
                                                </div>
                                                <div class="modal-footer">

                                                    <form action="{{ route('admin.types.destroy', $type->slug) }}"
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
                            <tr class="">
                                <td scope="row">Add a type</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div>
                    <form action="{{ route('admin.types.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Full Stack" aria-label="Button"
                                name="name" id="name">
                            <button class="btn btn-outline-secondary" type="submit">Add</button>
                        </div>

                    </form>
                </div>

            </div>


        </div>

    </div>
@endsection
