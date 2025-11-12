<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'post_id',
        'post_user_id',
        'comment',
        'slug',
    ];

    public function post_user(): BelongsTo
    {
        return $this->belongsTo(PostUser::class);
    }


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
