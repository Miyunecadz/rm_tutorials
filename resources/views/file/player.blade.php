@extends('layouts.authenticated')

@section('pages')
<div class="container" id="myElement">
    <div class="row justify-content-center" >

        <div class="mt-5">
            @if (pathinfo($file, PATHINFO_EXTENSION) == 'mp4' || pathinfo($file, PATHINFO_EXTENSION) == 'webm')
                <video height="700px" src="{{Storage::url($file)}}" controls controlsList="nodownload"></video>

            @else
                <embed height="700px" src="{{Storage::url($file)}}#toolbar=0" type="">
            @endif
        </div>
        {{-- <video height="300px" src="{{$file)}}"></video> --}}
    </div>
</div>

<script>
    (function () {
  var blockContextMenu, myElement;

  blockContextMenu = function (evt) {
    evt.preventDefault();
  };

  myElement = document.querySelector('#myElement');
  myElement.addEventListener('contextmenu', blockContextMenu);
})();
</script>
@endsection
