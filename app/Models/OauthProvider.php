<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthProvider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'provider_name',
        'provider_id',
    ];
}
