@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center align-content-center vh-100">
        <div class="col-md-4 ">
            <div class="d-flex justify-content-center gap-2">
                <img src="{{asset('images/elink-logo-site.png')}}" height="100" width="100" alt="" srcset="">
                {{-- <img src="{{asset('images/readers_magnet.png')}}" height="90" width="90" alt="" srcset=""> --}}
            </div>
            <h6 class="text-center">ELink Systems and Concept Corp</h6>
            <form action="{{route('authenticate')}}" method="post" class="card p-3 shadow">
                <div class="w-100 d-flex">
                    <a href="../" class="ms-auto text-decoration-none text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                    </a>
                </div>
                @csrf
                <div class="form-group my-2">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email Address" class="form-control">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group my-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="xxxxxxx" class="form-control">
                </div>
                <div class="form-group my-1">
                    <button type="submit" class="ms-auto btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
