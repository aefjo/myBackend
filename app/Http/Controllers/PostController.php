<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    public function create(Request $request) {
        return view('blog.create');
    }

    public function store(Request $request) {
        $imageName = null;
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $timestamp = Carbon::now()->format('YmdHis');
            $fileName = "{$timestamp}.{$extension}";
    
            $path = $file->storeAs('post-images', $fileName, 'public');
            $imageName = $fileName;
        }
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imageName,
        ]);
        return redirect('/posts');
    }

    public function edit($id) {
        $posts = Post::find($id);
        return view('blog.edit', [
            'posts' => $posts
        ]);
    }

    public function update(Request $request, $id) {
        // Temukan post berdasarkan ID
        $post = Post::findOrFail($id);

        // Proses image jika ada
        $imageName = $post->image; // Default ke image lama jika tidak ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $timestamp = Carbon::now()->format('YmdHis');
            $fileName = "{$timestamp}.{$extension}";
            $path = $file->storeAs('post-images', $fileName, 'public');
            $imageName = $fileName;
        }

        // Update data post
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->description = $request->input('description');
        $post->image =  $imageName; // Pastikan ini sesuai dengan nama field di model
        $post->save(); // Simpan perubahan

        return redirect('/posts');
    }

    public function delete($id) {
        $post = Post::findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete('post-images/' . $post->image);
        }
        $post->delete();
        return redirect('/posts');
    }
}

