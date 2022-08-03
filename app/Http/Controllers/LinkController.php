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

    public function edit(Link $link, Request $request)
    {
        return view('links.edit', [
            'link' => $link,
            'path' => $request->path
        ]);
    }

    public function update(Link $link, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);


        $exist = Link::where('name', $request->name)->where('id', '!=', $link->id)->first();
        $index = 1;

        while($exist && $exist->name == $data['name']){
            $data['name'] = $data['name'] ." ($index)";
            $index++;
        }


        $link->name = $data['name'];
        $link->url = $request->url;
        $link->save();

        return back()->with('success', 'Successfully update in the database!');
    }
}
