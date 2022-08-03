@extends('layouts.authenticated')

@section('pages')
    <div class="row justify-content-center align-content-center" style="height: 90vh">
        <div class="col-md-4 ">

            <h4 class="text-center">Edit Link</h4>
            <form action="{{route('links.update', ['link' => $link])}}" method="post" class="card p-3 shadow">
                <div class="w-100 d-flex">
                    <a href="{{ route('dashboard', ['path' => $path]) }}" class="ms-auto text-decoration-none text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </a>
                </div>
                @csrf
                @method('PUT')
                <div class="form-group my-2">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span>{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?? $link->name}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control" value="{{old('url') ?? $link->url}}">
                    @error('url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group my-1">
                    <button type="submit" class="ms-auto btn btn-primary">Add Link</button>
                </div>
            </form>
        </div>
    </div>
@endsection
