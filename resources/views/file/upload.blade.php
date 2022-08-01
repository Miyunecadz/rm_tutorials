@extends('layouts.authenticated')

@section('pages')
        <div class="row justify-content-center align-content-center" style="height: 90vh">
            <div class="col-md-4 ">
                <h4 class="text-center">File Upload</h4>
                <form action="" method="post" class="card p-3 shadow" enctype="multipart/form-data">
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span>{{Session::get('success')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
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
                    <div class="form-group my-2">
                        <label for="email">Browse</label>
                        <input type="file" name="file" id="file" class="form-control">
                        @error('file')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-1">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
