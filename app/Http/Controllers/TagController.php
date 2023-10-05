<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:tags',
        ]);

        if ($validator) {
            $tag = new Tag();
            $tag->name = $request->name;
            if ($tag->save()) {
                return redirect()->route('tags.index');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Creditial Error!');
            }
        }
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        // dd($tag->toArray());
        return view('tag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->toArray());
        $validator = $request->validate([
            'name' => 'required|unique:tags',
        ]);
        if ($validator) {
            $tag = Tag::find($id);
            $tag->name = $request->name;
            if ($tag->update()) {
                return redirect()->route('tags.index');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Updated Fail!');
            }
        }
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag->delete()) {
            return redirect()->back();
        }
    }
}
