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
}
