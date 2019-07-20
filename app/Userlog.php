<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
