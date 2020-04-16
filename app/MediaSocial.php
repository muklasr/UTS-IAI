<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaSocial extends Model
{
    protected $fillable = [
        'user_id', 'social_media', 'username'
    ];
}
