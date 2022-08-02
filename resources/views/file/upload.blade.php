@extends('layouts.authenticated')

@section('pages')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

        <div class="row justify-content-center align-content-center" style="height: 90vh">
            <div class="col-md-4 ">
                <h4 class="text-center">File Upload</h4>
                <div class="card p-3 shadow">
                    <div class="w-100 d-flex">
                        <a href="{{ route('dashboard', ['path' => $path]) }}" class="ms-auto text-decoration-none text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </a>
                    </div>

                    <div id="upload-container" class="text-center">
                        <button id="browseFileBtn" class="btn btn-primary">Browse File</button>
                    </div>

                    <div style="display:" class="progress mt-3" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 10%; height: 100%">10%</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<script>
    $(document).ready(() => {

        let browseBtn = $('#browseFileBtn')
        let resumable = new Resumable({
            target: '', // Route here.
            query: {
                _token:'{{ csrf_token() }}'
            }, // CSRF Token
            fileType: ['mp4', 'pdf', 'WebM'],
            chunkSize: 10*1024*1024,
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseBtn[0]);

        resumable.on('fileAdded', (file)=> {
            showProgress();
            resumable.upload();
        });

        resumable.on('fileProgress', (file)=>{
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', (file, response) => {
            response = JSON.parse(response);

        });

        resumable.on('fileError', (file, response) => {
            alert('File Uploading Error');
        });

        let progress = $('.progress');
        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    })
</script>
@endsection
