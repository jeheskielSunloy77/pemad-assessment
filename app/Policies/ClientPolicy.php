<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Client $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->user_id ? Response::allow() : Response::deny('You are not authorized to view this client, only the owner can view it!');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if ($user->role === 'admin' || $user->role === 'client') {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a client, only admin or client can create it!');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->user_id ? Response::allow() : Response::deny('You are not authorized to update this client, only the owner can update it!');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->user_id ? Response::allow() : Response::deny('You are not authorized to delete this client, only the owner can delete it!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Client $model): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to restore this client, only admin can restore it!');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Client $model): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to permanently delete this client, only admin can permanently delete it!');
    }
}
