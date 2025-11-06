<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
