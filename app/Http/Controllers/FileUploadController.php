<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function uploadPage(Request $request)
    {
        $path = $request->path ?? $this->rootDirectory;
        return view('file.upload', compact('path'));
    }


}
