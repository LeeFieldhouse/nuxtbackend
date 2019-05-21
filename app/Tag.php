<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
