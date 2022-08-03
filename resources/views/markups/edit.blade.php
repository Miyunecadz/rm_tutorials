@extends('layouts.authenticated')

@section('pages')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (Session::has('success'))

<script>
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: "{{Session::get('success')}}",
    showConfirmButton: false,
    timer: 1500
    })

</script>

@endif

<div class="container">
    <div class="row justify-content-center my-2">

        <form action="{{route('markups.update', ['markup' => $markup, 'path' => $path])}}" method="post">
            @csrf
            @method('PUT')
            <div class="d-flex">
                <div class="form-group my-2 w-50">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?? $markup->name}}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <a href="{{ route('dashboard', ['path' => $path]) }}" title="Exit" class="ms-auto text-decoration-none text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-x" viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </a>
            </div>
            <textarea id="summernote" name="content" >{{old('content') ?? $markup->content}}</textarea>

            <button type="submit" class="btn btn-primary my-2">Save</button>
        </form>

    </div>
</div>

<script>
    $(document).ready(function(){
        $('#summernote').summernote({
            height: 500,
        });
    });
</script>

@endsection
