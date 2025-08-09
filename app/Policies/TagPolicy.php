<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function attach(User $user, Tag $tag)
    {
        // Admin and SuperAdmin can attach any tag
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            return true;
        }

        // User can attach tags to their own projects
        return $user->id === $tag->projects->first()->user_id;
    }

    public function detach(User $user, Tag $tag)
    {
        // Admin and SuperAdmin can detach any tag
        if ($user->hasRole('admin') || $user->hasRole('superadmin')) {
            return true;
        }

        // User can detach tags from their own projects
        return $user->id === $tag->projects->first()->user_id;
    }
}
