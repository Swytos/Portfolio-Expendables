<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
	protected $table = 'projects';

	protected $fillable = ['name', 'url', 'description'];

	public function projectImages()
    {
	    return $this->hasMany(ProjectImages::class, 'project_id', 'id');
    }
}
