<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'username',
        'password',
        'website',
        'note'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
