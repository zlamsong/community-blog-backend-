<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['user_name', 'title', 'image', 'body'];

    public function user(){

    return $this->belongsTo(User::class);

    }
}

