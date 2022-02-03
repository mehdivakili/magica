<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function sitemap(){
        $links = [
            ['url'=>url('login'), 'updated_at'=>Carbon::now()]

        ];
        return response()->view('seo.sitemap',compact('links'))->header('Content-Type','text/xml');
    }
}
