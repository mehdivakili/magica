<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    public $additional_attributes = ['full_name'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getFullNameAttribute()
    {
        if ($this->question->type === "file")
            return $this->question->title . ': ' .'<a href="'.route('admin_get_picture_with_link',[$this->value]).'">'. $this->value.'</a>';
        else
            return $this->question->title . ': ' . $this->value;
    }


}
