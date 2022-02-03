<?php

namespace App;

use App\Events\TicketUpdated;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    protected $fillable = ['title','description','status'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected $dispatchesEvents = [
        'updated'=>TicketUpdated::class
    ];
}
