<?php

namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';

    protected $fillable = ['post_id', 'image_path'];

    public $timestamps = false;
}
