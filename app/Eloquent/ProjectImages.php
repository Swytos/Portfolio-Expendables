<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    protected $table = 'project_images';
    public $timestamps = false;
    protected $fillable = ['project_id', 'image_path'];

    public function projects() {
       return $this->belongsTo(Projects::class);
    }
}
