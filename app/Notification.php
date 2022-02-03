<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    public function scopeMain($query){
        return $query->where('user_id',0);
    }


    public function
    scopeForUser($query){
        return $query->where('created_at','>=',Auth::user()->created_at)->where(function ($query){
            $query->where('user_id',Auth::user()->id)->orWhere('user_id',0);

        });
    }

}
