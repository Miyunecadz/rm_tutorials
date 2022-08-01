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

        $urls = $this->getUrl($path);
        return view('dashboard', compact('path', 'files', 'directories', 'urls'));
    }


    private function getUrl($path)
    {
        $sections = explode("/", $path);
        $currentValue = "";
        $urls = [];

        foreach($sections as $section){
            $urls[$section == 'public' ? 'home' : $section] = $currentValue . $section . "/";
            $currentValue = $currentValue . $section . "/";
        }


        return $urls;
    }

    public function create(Request $request)
    {
        $path = $request->path ?? $this->rootDirectory;
        return view('file.create', compact('path'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Storage::makeDirectory($request->path . '/' . $request->name);

        return back()->with('success', 'New folder has been created!');
    }

    public function renamePage(Request $request)
    {
        $path = $request->path ?? $this->rootDirectory;
        return view('file.rename', compact('path'))->with('success', 'New folder has been created!');
    }

    public function delete(Request $request)
    {
        $path = $request->path;
       Storage::deleteDirectory($path);

       return back();
    }
}
