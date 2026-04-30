<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('back.post.index', compact('posts'));
    }

    public function create()
    {
        return view('back.post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required|min:20',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'author.required' => 'L\'auteur est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 20 caractères.',
            'image.required' => 'L\'image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg ou png.',
            'image.max' => 'L\'image ne doit pas dépasser 2Mo.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('back.posts.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Post $post)
    {
        return view('back.post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required|min:20',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'author.required' => 'L\'auteur est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 20 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg ou png.',
            'image.max' => 'L\'image ne doit pas dépasser 2Mo.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('back.posts.index')->with('success', 'Article modifié avec succès.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('back.posts.index')->with('success', 'Article supprimé avec succès.');
    }
}
