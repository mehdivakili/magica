<?php

namespace App\Http\Controllers;

use App\Art;
use App\Category;
use App\dataIdManager;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ArtController extends Controller
{
    public function index_templates()
    {
        $bookmarks = new dataIdManager(Auth::user(), false, 'bookmarks');
        $bookmarks = $bookmarks->get_all();
        return view('panel.arts', ['categories' => Category::templates()->get(), 'bookmarks' => $bookmarks, 'js' => ['photo', 'photo-btn'],'page_title'=>'create order']);
    }

    public function index_ctemplates()
    {
        $bookmarks = new dataIdManager(Auth::user(), false, 'bookmarks');
        $bookmarks = $bookmarks->get_all();
        return view('panel.arts', ['categories' => Category::cTemplates()->get(), 'bookmarks' => $bookmarks, 'js' => ['photo', 'photo-btn'],'page_title'=>'edit pictures']);
    }

    public function create_show(Art $art)
    {
        $bookmarks = new dataIdManager(Auth::user(), false, 'bookmarks');
        $is_bookmarked = $bookmarks->have_id($art->id);
        return view('panel.art', ['art' => $art,'is_bookmarked'=>$is_bookmarked ,'js' => ['create_order']]);
    }

    function showSaves()
    {
        $bookmarks = new dataIdManager(Auth::user(), false, 'bookmarks');
        $arts = Art::find($bookmarks->get_all());
        return view('panel.bookmarks', ['arts' => $arts, 'js' => ['photo']]);
    }

    public function category_index()
    {
        return view('admin_panel.export',['category'=>Category::where('parent_id', Category::where([['slug', 'templates'], ['parent_id' => null]])->get()[0]->id)->get(),'category2'=>Category::where('parent_id', Category::where([['slug', 'ctemplates'], ['parent_id' => null]])->get()[0]->id)->get()]);
    }

    public function search(Request $request)
    {
        $request->validate([
            's' => 'string|required|max:40'
        ]);
        $search = $request->input('s');
        $tags = Tag::where('title', 'like', "%{$search}%")->get();
        $arts = [];
        foreach ($tags as $tag){
            foreach ($tag->arts as $art){
                $arts[$art->id] = $art;
            }
        }
        return view('panel.search', ['arts' => $arts, 'js' => ['photo']]);
    }
}
