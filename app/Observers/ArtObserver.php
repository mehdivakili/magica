<?php

namespace App\Observers;

use App\Art;
use App\Tag;
use function GuzzleHttp\json_decode;

class ArtObserver
{
    /**
     * Handle the art "created" event.
     *
     * @param  \App\Art  $art
     * @return void
     */
    public function created(Art $art)
    {
        $art->arrangement = $art->id;
        $art->save();
        foreach (json_decode($art->selected_tags) as $tag_name){

            if(Tag::where('name',$tag_name)->exists()){
                $tag = Tag::where('name',$tag_name)->first();

                $tag->arts()->attach($art);
                $tag->save();

            }else{
                $tag = new Tag();
                $tag->name = str_replace(' ',"_",$tag_name);
                $tag->title = $tag_name;
                $tag->save();
                $tag->arts()->attach($art);
                $tag->save();
            }
        }
    }

    /**
     * Handle the art "updated" event.
     *
     * @param  \App\Art  $art
     * @return void
     */
    public function updated(Art $art)
    {


        foreach ($art->tags as $tag){

            $tag->arts()->detach($art);
        }


        foreach (json_decode($art->selected_tags) as $tag_name){

            if(Tag::where('name',$tag_name)->exists()){
                $tag = Tag::where('name',$tag_name)->first();

                $tag->arts()->attach($art);
                $tag->save();

            }else{
                $tag = new Tag();
                $tag->name = str_replace(' ',"_",$tag_name);
                $tag->title = $tag_name;
                $tag->save();
                $tag->arts()->attach($art);
                $tag->save();
            }
        }
    }

    /**
     * Handle the art "deleted" event.
     *
     * @param  \App\Art  $art
     * @return void
     */
    public function deleted(Art $art)
    {
        //
    }

    /**
     * Handle the art "restored" event.
     *
     * @param  \App\Art  $art
     * @return void
     */
    public function restored(Art $art)
    {
        //
    }

    /**
     * Handle the art "force deleted" event.
     *
     * @param  \App\Art  $art
     * @return void
     */
    public function forceDeleted(Art $art)
    {
        //
    }
}
