<?php

namespace Mlbrgn\LaravelFormComponents\Tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;

class PostBelongsToMany extends Model
{
    protected $table = 'posts';

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'comment_post', 'post_id', 'comment_id');
    }
}
