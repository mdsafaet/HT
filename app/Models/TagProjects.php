<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagProjects extends Model
{
    protected $table = 'tag_projects';
    protected $fillable = [
        'project_id',
        'tag_id',
    ];
}
