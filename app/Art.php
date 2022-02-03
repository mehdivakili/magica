<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;


class Art extends Model
{
    use Resizable;
    protected $table = 'arts';
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function questions(){
        return $this->belongsToMany(Question::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
