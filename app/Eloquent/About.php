<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = ['name', 'image', 'description', 'date'];
}
