<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{

    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at'=>'datetime'
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class)->orderBy('updated_at','DESC');
    }
    public function orders(){
        return $this->hasMany(Order::class)->withTrashed()->orderBy('updated_at','DESC');
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function upgrade_account($type){
        $this->type = $type;
        $this->save();
    }
}
