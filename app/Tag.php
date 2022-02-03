<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function arts()
    {
        return $this->belongsToMany(Art::class);
    }

    public function scopeTagSelected($query,Art $art)
    {
        $tags = $this->all();

        foreach ($tags as $k => $tag){
            if($art->tags()->find($tag)){
                $tag->selected = true;
            }else{
                $tag->selected = false;
            }
        }
        return $tags;
    }
}
