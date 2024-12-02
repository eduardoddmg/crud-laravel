<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Lista todos os posts
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Cria um novo post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    // Exibe um post específico
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Atualiza um post existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }

    // Remove um post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deletado com sucesso']);
    }
}
