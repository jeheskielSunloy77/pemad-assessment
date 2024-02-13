<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    private function isAuthorized(User $user, Project $model): bool
    {
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'user' && $user->id === $model->user_id) {
            return true;
        }
        if ($user->role === 'client' && $user->client->id === $model->client_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
        // return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to view any projects, only the admin can view it!');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $model): Response
    {
        return $this->isAuthorized($user, $model) ? Response::allow() : Response::deny('You are not authorized to view this project, only the owner can view it!');
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
    public function update(User $user, Project $model): Response
    {
        return $this->isAuthorized($user, $model) ? Response::allow() : Response::deny('You are not authorized to update this project, only the owner can update it!');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $model): Response
    {
        return  $this->isAuthorized($user, $model) ? Response::allow() : Response::deny('You are not authorized to delete this project, only the owner can delete it!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $model): Response
    {
        return $this->isAuthorized($user, $model) ? Response::allow() : Response::deny('You are not authorized to restore this project, only the owner can restore it!');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $model): Response
    {
        return $this->isAuthorized($user, $model) ? Response::allow() : Response::deny('You are not authorized to permanently delete this project, only the owner can permanently delete it!');
    }
}
