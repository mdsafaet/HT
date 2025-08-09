<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{

    use HandlesAuthorization;

     public function update(User $user, Task $task)
    {
        // Admin and SuperAdmin can update any task
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            return true;
        }

        // User can update tasks within their own projects
        return $user->id === $task->project->user_id;
    }

    public function delete(User $user, Task $task)
    {
        // Admin and SuperAdmin can delete any task
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            return true;
        }

        // User can delete tasks within their own projects
        return $user->id === $task->project->user_id;
    }
    

}
