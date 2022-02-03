<?php

namespace App;

use App\Events\OrderDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','answers','order_image','status'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function art(){
        return $this->belongsTo(Art::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }


//    protected $dispatchesEvents = [
//        'deleted'=>OrderDeleted::class
//    ];
}
