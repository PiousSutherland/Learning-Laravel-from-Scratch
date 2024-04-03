<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $attributes = array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        $post = new Post($attributes);

        // Using setSlugAttribute
        $post->slug = $post->title;

        // Persist
        $post->save();

        return redirect("/post/{$post->slug}")->with('success', 'Here\'s the post you just created!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post, 'categories' => \App\Models\Category::all()]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost();

        if ($attributes['thumbnail'] ?? false)
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        $post->update($attributes);

        return redirect("/post/{$post->slug}")->with('success', 'Updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post deleted.');
    }

    public function validatePost(?Post $post = null)
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? 'image' : 'required|image',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);
    }
}
