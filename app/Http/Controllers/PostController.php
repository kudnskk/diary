<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get(); // Fetch all posts
        return view('posts.show', ['posts' => $posts]); // Pass $posts to the view
    }

    public function create()
    {
        $categories = Category::all(); // Assuming you have a Category model
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'photos.*' => 'image|max:2048', // Validate each uploaded photo
    ]);

    // Create the post
    $post = new Post();
    $post->title = $request->title;
    $post->content = $request->content;
    $post->category_id = $request->category_id;
    $post->user_id = Auth::id(); // Assign the authenticated user's ID
    $post->save();

    // Upload and link photos
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $file) {
            $filename = $file->store('public/photos');
            $photo = new Photo();
            $photo->filename = Storage::url($filename);
            $post->photos()->save($photo);
        }
    }

    return redirect()->route('dashboard')->with('success', 'Post created successfully.');
}
    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id); // Fetch post by ID
        return view('posts.show', compact('post')); // Pass post to the view
    }
/**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all(); // Fetch all categories

        return view('posts.edit', compact('post', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|max:2048', // Ensure photo validation allows null and image types
        ]);
    
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
    
        $post->save();
    
        // Handle photo update
        if ($request->hasFile('photo')) {
            // Delete old photos associated with the post
            foreach ($post->photos as $photo) {
                Storage::delete('public/' . $photo->filename);
                $photo->delete();
            }
    
            // Store new photo
            $path = $request->file('photo')->store('public/photos');
            $photo = new Photo();
            $photo->filename = Storage::url($path);
            $photo->post_id = $post->id;
            $photo->save();
        }
    
        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }
    


    public function destroy($id)
{
    $post = Post::findOrFail($id);

    foreach ($post->photos as $photo) {
        Storage::delete('public/' . str_replace('/storage/', '', $photo->filename));
        $photo->delete();
    }

    $post->delete();

    return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
}


    /**
     * Display posts by category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function postsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $posts = Post::where('category_id', $categoryId)->latest()->get();
        return view('posts.category', compact('category', 'posts'));
    }
}
