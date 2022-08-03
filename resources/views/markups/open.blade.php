@extends('layouts.authenticated')

@section('pages')

<div class="container">
    <div class="row justify-content-center my-3">
        <div class="d-flex">
            <div class="form-group my-2 w-50">
                <h5>{{$markup->name}}</h5>
            </div>
            <a href="{{ route('dashboard', ['path' => $path]) }}" title="Exit" class="ms-auto text-decoration-none text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-x" viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </a>
        </div>

        <div class="card p-2">
            {!! $markup->content !!}
        </div>
    </div>
</div>

@endsection
