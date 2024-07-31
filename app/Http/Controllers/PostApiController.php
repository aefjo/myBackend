<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use GuzzleHttp\Psr7\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostApiController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->json([
            'message' => 'SUKSES ALL GET',
            'data' => $posts
        ], 200);
    }

    public function show($id) {
        $posts = Post::find($id);
        return response()->json([
            'message' => 'SUKSES GET ONE',
            'data' => $posts
        ], 200);
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

        $posts = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return response()->json([
            'message' => 'SUKSES ADD',
            'data' => $posts
        ], 200);
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

        return response()->json([
            'message' => 'SUKSES UPDATE',
            'data' => $post
        ], 200);
    }

    public function delete($id) {
        $post = Post::findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete('post-images/' . $post->image);
        }
        $post->delete();
        return response()->json([
            'message' => 'HAPUS SUKSES',
            'data' => null
        ], 200);
    }

}
