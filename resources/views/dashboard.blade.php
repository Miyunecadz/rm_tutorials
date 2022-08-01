@extends('layouts.authenticated')

@section('pages')
    <div class="container mt-4">
        <div class="d-flex">
            <h5>File Manager</h5>
            <div class="ms-auto d-flex gap-2">
                <a class="btn btn-sm btn-outline-secondary" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="me-1" fill="currentColor"
                        class="bi bi-folder-plus" viewBox="0 0 16 16">
                        <path
                            d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                        <path
                            d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    New Folder
                </a>
                <button class="btn btn-sm btn-outline-primary">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                        <path
                            d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z" />
                        <path
                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                    </svg>
                    File Upload
                </button>
            </div>
        </div>
        <hr>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($urls as $key => $value)
                    <li class="breadcrumb-item  {{$key == basename($path) ? "active" : ''}}">
                        @if ($key == basename($path))
                            {{Str::title($key)}}
                        @else
                            <a href="{{route('dashboard', ['path' => $value])}}">{{Str::title($key)}}</a>

                        @endif
                    </li>

                @endforeach

            </ol>
        </nav>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            @foreach ($directories as $directory)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex">
                            <div class="d-flex w-100 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="28" fill="currentColor"
                                    class="bi bi-folder" viewBox="0 0 16 16">
                                    <path
                                        d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                </svg>
                                {{ basename($directory) }}
                                {{-- <a class="stretched-link" href="{{ route('index', ['path' => $directory]) }}"></a> --}}
                            </div>
                            <div class="dropdown ms-auto">
                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="">
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('dashboard', ['path' => $directory]) }}">Open</a></li>
                                    <li><a class="dropdown-item" href="{{ route('folder.renamePage', ['path' => $directory]) }}">Rename</a></li>
                                    <li><a class="dropdown-item" href="{{ route('folder.delete', ['path' => $directory]) }}">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach ($files as $file)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex ">
                            <div class="d-flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="28" fill="currentColor"
                                    class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                </svg>
                                {{ basename($file) }}
                            </div>
                            <div class="dropdown ms-auto">
                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="">
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Open</a></li>
                                    <li><a class="dropdown-item" href="#">Rename</a></li>
                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        @if (count($files) <= 0 && count($directories) <= 0)
            <div class="row justify-content-center align-content-center" style="height: 80vh">
                <div class="col-md-4 ">
                    <div class="d-flex justify-content-center gap-2">
                        <img src="{{ asset('images/empty-folder.png') }}" height="100" width="100" alt="" srcset="">
                        {{-- <img src="{{asset('images/readers_magnet.png')}}" height="90" width="90" alt="" srcset=""> --}}
                    </div>
                    <h6 class="text-center">This directory is empty</h6>

                </div>
            </div>
        @endif
    </div>
@endsection
