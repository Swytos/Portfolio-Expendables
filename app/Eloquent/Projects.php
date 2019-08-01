<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
	protected $table = 'projects';

	protected $fillable = ['name', 'image', 'url', 'description', 'team_size', 'platform', 'skills', 'timeline'];
}
