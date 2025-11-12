<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    protected $fillable = [
        'post_id',
        'post_user_id',
        'comment',
    ];
}
