<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los posts
        $posts = Post::all();
        return response()->json($posts); // Retornar los posts en formato JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Crear el post
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->id(), // Asignar el post al usuario autenticado
        ]);

        // Retornar el post creado con un código 201 (Created)
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar un post específico
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
{
    // Validar los datos del request
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    // Verifica si el usuario tiene permiso para actualizar el post
    $this->authorize('update', $post);

    // Actualizar el post con los nuevos datos
    $post->update($request->only(['title', 'content']));

    return response()->json(['message' => 'Post actualizado correctamente', 'post' => $post]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Verifica si el usuario tiene permiso para eliminar el post
        $this->authorize('delete', $post);

        // Lógica para eliminar el post
        $post->delete();

        return response()->json(['message' => 'Post eliminado correctamente']);
    }
}
