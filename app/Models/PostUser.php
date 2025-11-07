<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostUser extends Model
{
    protected $table = "post_users";
    
    protected $fillable = [
        'fullname',
        'email',
        'profile',
        'password',
        'slug'
    ];

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }
}
