<?php


namespace App\Voyager\FormFields;

use App\Tag;
use TCG\Voyager\FormFields\AbstractHandler;

class TagsFormField extends AbstractHandler
{
    protected $codename = 'tag';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        $tags = Tag::all();
        $selected_tags = [];
        foreach ($tags as $k => $tag){
            if($dataTypeContent->tags()->has($tag)){
                $tag->selected = true;
                $selected_tags[] = $tag;
            }else{
                $tag->selected = false;
            }
        }
dd('hhhhhhhhhhhhhhhhhhhhhhhh');
        return view('vendor.voyager.FormFields.tag', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent,
            'tags'=>$tags,
            'selected_tags'=>$selected_tags
        ]);
    }
}
