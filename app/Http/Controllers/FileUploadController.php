<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileUploadController extends Controller
{
    public function uploadPage(Request $request)
    {
        $path = $request->path ?? $this->rootDirectory;
        return view('file.upload', compact('path'));
    }

    public function uploadLargeFiles(Request $request) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $fileName = $request->newFileName != '' ? $request->newFileName .'.'.$file->getClientOriginalExtension() : $file->getClientOriginalName();

            $path = Storage::putFileAs($request->path, $file, $fileName);

            // $disk = Storage::disk(config('filesystems.default'));
            // $path = $disk->putFileAs('videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function delete(Request $request)
    {
       Storage::delete($request->file);
       return back();
    }
}
