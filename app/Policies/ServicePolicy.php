<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServicePolicy
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
    public function view(User $user, Service $model): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->user_id ? Response::allow() : Response::deny('You are not authorized to update this service, only the owner can update it!');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->user_id ? Response::allow() : Response::deny('You are not authorized to delete this service, only the owner can delete it!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $model): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to restore this service, only admin can restore it!');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $model): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to permanently delete this service, only admin can permanently delete it!');
    }
}
