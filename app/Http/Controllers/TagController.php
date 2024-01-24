<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        Tag::create($request->validate([
            'tag_name' => 'sometimes|required|max:255|unique:tags',
            'tag_slug' => 'sometimes|required|max:255|unique:tags',
        ]));
        // $request->session()->put('success', 'Tag đã tạo thành công!');
        return redirect()->route('tags.index');
    }

    // public function edit($id)
    // {
    //     $tag = Tag::findOrFail($id);
    //     return view('tags.edit', compact('tag'));
    // }

    public function update(Request $request, $id)
    {
        // Find the tag to update
        $tag = Tag::findOrFail($id);
        $tag->tag_name = $request->input('tag_name');
        $tag->tag_slug = $request->input('tag_slug');
        $tag->save();
        $request->session()->put('success', 'Tag đã cập nhật thành công!');

        // Return a response with a success message
        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
