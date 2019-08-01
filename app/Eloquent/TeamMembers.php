<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TeamMembers extends Model
{
	protected $table = 'team_members';

	protected $fillable = ['full_name', 'role', 'description', 'image'];
}
