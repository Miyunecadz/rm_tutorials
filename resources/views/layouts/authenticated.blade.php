@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg  navbar-dark shadow" style="background: #b71515 !important">
    <div class="container">
      <a class="navbar-brand" href="{{route('dashboard')}}">RM Online Tutorials</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login Administrator</a>
                </li>
            @endguest
            @auth
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{auth()->user()->getFullName()}}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('user.edit-password')}}">Change Password</a></li>
                    <li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
            @endauth

        </ul>
      </div>
    </div>
  </nav>
    @yield('pages')
@endsection
