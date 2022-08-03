<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Markup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    private $defaultPath = 'public/';

    public function index(Request $request)
    {
        $path = $request->path ?? $this->defaultPath;
        $files = Storage::files($path);
        $directories = Storage::directories($path);
        $links = Link::where('path', $path)->orWhere('path', $path .'/')->get();
        $markups = Markup::where('path', $path)->orWhere('path', $path .'/')->get();

        $urls = $this->getUrl($path);
        return view('dashboard', compact('path', 'files', 'directories', 'urls', 'links', 'markups'));
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

        if(Storage::exists($request->path . '/' . $request->name)){
            return back()->withErrors(['name'=> 'Folder already exist']);
        }
        Storage::makeDirectory($request->path . '/' . $request->name);

        return back()->with('success', 'New folder has been created!');
    }

    public function delete(Request $request)
    {
       Storage::deleteDirectory($request->path);
       return back();
    }

    public function downloadFile(Request $request)
    {
        return Storage::download($request->file);
        // Storage::download($request->file);
        // return back();
    }

    public function openFile(Request $request)
    {
        $video = $request->path;
        return view('file.player', compact('video'));
    }

    public function getVideo(Request $request)
    {
        $video = Storage::get($request->video);
        $response = Response::make($video, 200);
        $response->header('Content-Type', 'video/mp4');
        return $response;
    }
}
