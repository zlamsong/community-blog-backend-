<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nick_name', 'birthday', 'city', 'email', 'phone', 'education'];

    public function user(){

    return $this->belongsTo(User::class);

    }
}
