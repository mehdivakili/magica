<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function arts()
    {
        return $this->hasMany(Art::class)->orderBy('arrangement');
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Art::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Art::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('arrangement');
    }

    public function scopeNonMain($query)
    {
        return $query->where('parent_id', '!=', null)->orderBy('arrangement');
    }

    public function scopeTemplates($query)
    {
        $template = $query->where([['slug', 'templates'], ['parent_id' => null]])->first();
        return $template->categories();
    }

    public function scopeCTemplates($query)
    {
        $template = $query->where([['slug', 'ctemplates'], ['parent_id' => null]])->first();
        return $template->categories();
    }

    public function getWithParentNameAttribute()
    {
        $parent_name = Category::find($this->parent_id)->name;
        return "{$this->name} - {$parent_name}";
    }

    public $additional_attributes = ['with_parent_name'];


}
