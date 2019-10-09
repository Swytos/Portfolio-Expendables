<?php

namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['post_content', 'post_category', 'post_title'];

    public function postTags() {
        return $this->hasMany('App\Eloquent\Blog\PostTag','post_id','id');
    }

    public function postImages() {
        return $this->hasMany('App\Eloquent\Blog\PostImage','post_id','id');
    }
}
