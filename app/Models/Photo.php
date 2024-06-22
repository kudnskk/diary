<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['post_id', 'filename'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

