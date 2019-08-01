<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = ['name', 'icon', 'description'];
}
