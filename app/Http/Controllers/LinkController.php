<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function create(Request $request)
    {
        $path = $request->path ?? $this->rootDirectory;
        return view('file.addlink', compact('path'));
    }

    public function store(Request $request)
    {
        $data =$request->validate([
            'name' => 'required',
            'url' => 'required|url'
        ]);

        $exist = Link::where('name', $request->name)->first();
        $index = 1;

        while($exist && $exist->name == $data['name']){
            $data['name'] = $data['name'] ." ($index)";
            $index++;
        }

        Link::create([
            'name' => $data['name'],
            'url' => $request->url,
            'path' => $request->path
        ]);

        return back()->with('success', 'Successfully added new link!');
    }

    public function delete(Link $link)
    {
        $link->delete();

        return back();
    }
}
