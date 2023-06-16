@extends('layouts.admin')


@section('content')
    <h1>Show Technology Table</h1>
    <a class="btn btn-dark my-3" href="{{ route('admin.technologies.create') }}" role="button">Create technology</a>

    @include('partials.session_message')

    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless table-primary align-middle">
            <thead class="table-light">

                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tecnology</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

                @forelse ($technologies as $technology)
                    <tr class="table-primary">
                        <td scope="row">{{ $technology->id }}</td>
                        <td>{{ $technology->name }}</td>
                        <td><img height="100" src="{{ asset('storage/' . $technology->technology_image) }}"
                                alt="{{ $technology->name }}"></td>
                        <td>
                            <a href="{{ route('admin.technologies.edit', $technology) }}" title="Edit"
                                class="text-decoration-none">
                                <i class="fas fa-pencil fa-sm fa-fw"></i>
                            </a>
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
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
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure?
                                        </div>
                                        <div class="modal-footer">

                                            <form action="{{ route('admin.technologies.destroy', $technology->slug) }}"
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
                        <td scope="row">No technologies yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $technologies->links('pagination::bootstrap-5') }}
    </div>
@endsection
