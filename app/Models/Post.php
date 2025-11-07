<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'post_user_id',
        'title',
        'image',
        'description',
        'comments',
        'slug'
    ];

    public function post_user(): BelongsTo
    {
        return $this->belongsTo(PostUser::class, 'post_user_id');
    }
}
