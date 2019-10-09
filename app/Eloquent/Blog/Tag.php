<?php

namespace App\Eloquent\Blog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['tag_name'];

    public function postTags() {
        return $this->hasOne(new PostTag());
    }
}
