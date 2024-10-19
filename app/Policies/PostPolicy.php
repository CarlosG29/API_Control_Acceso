<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Cualquiera puede ver los posts
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return true; // Cualquiera puede ver un post individual
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Cualquier usuario autenticado puede crear posts
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post)
    {
        // El administrador puede actualizar cualquier post, los usuarios regulares solo sus propios posts
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        // El administrador puede eliminar cualquier post, los usuarios regulares solo sus propios posts
        return $user->role === 'admin' || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        // Si decides implementar restauración, el administrador puede restaurar cualquier post
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        // Si decides implementar eliminación permanente, el administrador puede forzar la eliminación
        return $user->role === 'admin';
    }
}
