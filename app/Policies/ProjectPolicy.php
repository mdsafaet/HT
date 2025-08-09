<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Project $project)

    
    {
        if($user->hasRole("admin")||$user->hasRole('superadmin')) {
         return true;
      
    }
      return $user->id === $project->user_id;
}

    public function create(User $user)
    {
        // Any authenticated user can create their own projects
        return $user->hasRole('user') || $user->hasRole('admin') || $user->hasRole('superadmin');
    }

    public function update(User $user, Project $project)
    {
        // Admin and SuperAdmin can update any project
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            return true;
        }

        // User can update their own project
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project)
    {
        // Admin and SuperAdmin can delete any project
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            return true;
        }

        // User can delete their own project
        return $user->id === $project->user_id;
    }
}
