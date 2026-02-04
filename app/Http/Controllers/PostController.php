<?php

namespace App\Http\Controllers;

use App\Models\Likeable;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);


        $request->user()->posts()->create($validated);

        return Redirect::route('timeline')->with('status', 'post-created');
    }

    public function view(Request $request, Post $post): View|RedirectResponse
    {


        $post = $post->with('likes');


        return view('postEdit', [
            'post' => $post,
        ]);
    }
    /**
     * Muestra el formulario para editar un post.
     */
    public function edit(Request $request, Post $post): View|RedirectResponse
    {

        if (!$request->user()->can('edit.posts') && $post->user_id !== $request->user()->id) {
            return Redirect::to('/timeline')->with('error', 'No tienes permiso para editar este post.');
        }

        $post->load('likes');


        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Actualiza el contenido del post.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        
        if (!$request->user()->can('edit.posts') && $post->user_id !== $request->user()->id) {
            return Redirect::to('/timeline');
        }


        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $post->update($validated);

        return Redirect::route('timeline')->with('status', 'post-updated');
    }

    /**
     * Borra un post específico.
     */
    public function destroy(Request $request, Post $post): RedirectResponse
    {

        if (!$request->user()->can('delete.posts') && $post->user_id !== $request->user()->id) {
            return Redirect::to('/timeline');
        }


        $post->delete();

        return Redirect::to('/timeline')->with('status', 'post-deleted');
    }

    public function like(Post $post)
    {
        // Obtenemos el usuario autenticado
        $user = auth()->user();

        // Verificamos si ya le dio like
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // Si ya existe, lo eliminamos (Unlike)
            $like->delete();
        } else {
            // Si no existe, lo creamos
            $post->likes()->create([
                'user_id' => $user->id
            ]);
        }

        // Redirigimos a la página anterior
        return back();
    }
}