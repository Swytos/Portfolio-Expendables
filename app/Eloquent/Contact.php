<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['name', 'email', 'message', 'company'];
}
