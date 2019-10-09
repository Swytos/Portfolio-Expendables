<?php

namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tags';

    protected $fillable = ['post_id', 'post_tag'];

    public $timestamps = false;

    public function posts() {
        return $this->belongsTo(new Post);
    }

    public function tag() {
        return $this->belongsTo(new Tag());
    }
}
