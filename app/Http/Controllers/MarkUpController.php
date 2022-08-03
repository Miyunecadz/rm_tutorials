<?php

namespace App\Http\Controllers;

use App\Models\Markup;
use Illuminate\Http\Request;

class MarkUpController extends Controller
{
    public function create(Request $request)
    {
        return view('markups.create', ['path' => $request->path]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        $exist = Markup::where('name', $request->name)->first();
        $index = 1;

        while($exist && $exist->name == $data['name']){
            $data['name'] = $data['name'] ." ($index)";
            $index++;
        }

        Markup::create([
            'name' => $data['name'],
            'content' => $data['content'],
            'path' => $request->path
        ]);

        return back()->with('success', 'Successfully store in the database!');
    }

    public function open(Request $request, Markup $markup)
    {
        return view('markups.open', [
            'markup' => $markup,
            'path' => $request->path
        ]);
    }

    public function edit(Request $request, Markup $markup)
    {
        return view('markups.edit', [
            'markup' => $markup,
            'path' => $request->path
        ]);
    }

    public function update(Request $request, Markup $markup)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        $exist = Markup::where('name', $request->name)->where('id', '!=', $markup->id)->first();
        $index = 1;

        while($exist && $exist->name == $data['name']){
            $data['name'] = $data['name'] ." ($index)";
            $index++;
        }

        $markup->name = $data['name'];
        $markup->content = $request->content;
        $markup->save();

        return back()->with('success', 'Successfully update in the database!');
    }

    public function delete(Markup $markup)
    {
        $markup->delete();

        return back();
    }
}
