<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->get();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id,
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully.');
    }
}
