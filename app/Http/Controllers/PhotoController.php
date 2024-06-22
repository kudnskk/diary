<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'photo' => 'required|image|max:2048', // Example validation rules for image uploads
        ]);

        $post = Post::findOrFail($postId);

        // Store the photo in storage
        $path = $request->file('photo')->store('photos');

        // Create a record in the photos table
        $photo = new Photo();
        $photo->post_id = $post->id;
        $photo->filename = $path;
        $photo->save();

        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Photo uploaded successfully.');
    }

    public function destroy($photoId)
    {
        $photo = Photo::findOrFail($photoId);

        // Delete the photo from storage
        Storage::delete($photo->filename);

        // Delete the photo record from the database
        $photo->delete();

        return back()->with('success', 'Photo deleted successfully.');
    }
}

