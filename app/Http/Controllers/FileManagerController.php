<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    private $defaultPath = 'public';
    public function index(Request $request)
    {
        $path = $request->path ?? $this->defaultPath;
        $files = Storage::files($path);
        $directories = Storage::directories($path);

        return view('dashboard', compact('path', 'files', 'directories'));
    }
}
