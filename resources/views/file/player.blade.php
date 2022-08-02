@extends('layouts.authenticated')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center vh-100" >
        <video height="300px" src="{{route('get.video', ['video' => $video])}}"></video>
    </div>
</div>
@endsection
