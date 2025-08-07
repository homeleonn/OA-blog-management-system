<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'content', 'post_id', 'created_at'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
