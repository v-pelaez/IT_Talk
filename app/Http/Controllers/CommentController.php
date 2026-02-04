<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Guarda un nuevo comentario.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'active' => ['nullable', 'boolean'],
        ]);

        // El user_id se asigna automáticamente a través de la relación
        $request->user()->comments()->create($validated);

        return back()->with('status', 'Comment-created');
    }

    /**
     * Muestra el formulario para editar un comentario.
     */
    public function edit(Request $request, Comment $comment): View|RedirectResponse
    {
        // Verificación
        if (!$request->user()->can('edit.comments') && $comment->user_id !== $request->user()->id) {
            return Redirect::to('/timeline')->with('error', 'No tienes permiso para editar este comentario.');
        }

        // Cargamos las relaciones necesarias para la vista
        $comment->load('likes');

        return view('comment.edit', [
            'comment' => $comment,
        ]);
    }

    /**
     * Actualiza el contenido del comentario.
     */
    public function update(Request $request, Comment $comment): RedirectResponse
    {
        
        if (!$request->user()->can('edit.comments')  && $comment->user_id !== $request->user()->id) {
            return Redirect::to('/timeline');
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $comment->update($validated);

        
        return Redirect::route('post',$comment->post_id)->with('status', 'Comment-updated');
        
    }

    /**
     * Borra un comentario específico.
     */
    public function destroy(Request $request, Comment $comment): RedirectResponse
    {
        
        if (!$request->user()->can('delete.comments')  && $comment->user_id !== $request->user()->id) {
            return Redirect::to('/timeline')->with('error', 'No puedes borrar este comentario.');
        }

        
        $comment->delete();

        return back()->with('status', 'Comment-deleted');
    }

    /**
     * Gestiona los likes/unlikes.
     */
    public function like(Comment $comment)
    {
        $user = auth()->user();

        // Verificamos si ya existe el like para alternar 
        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create([
                'user_id' => $user->id
            ]);
        }

        return back();
    }
}