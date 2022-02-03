<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/aboutUs', function () {
    return view('aboutUs');
});

App::setLocale('fa');
//Route::group(array('before' => 'auth'), function(){
/*   Route::post('phone_number_verification',[ 'as' => 'phone_number_verification', 'uses' => 'HomeController@varify_phone_number_create']);
Route::get('phone_number_verification',[ 'as' => 'phone_number_verification', 'uses' =>'HomeController@varify_phone_number']);*/
   //Route::post('varify',[ 'as' => 'varify', 'uses' =>'HomeController@varify_phone_number']);
//});
Auth::routes(['verify' => true]);




Route::group(['prefix' => 'admin'], function () {

    Voyager::routes();
});
Route::group(['prefix' => 'admin','middleware' => 'admin.user'], function () {

    Route::get('/export/{category:slug}','AdminController@export');
    Route::get('/export','ArtController@category_index');
    Route::get('import',function (){
        return view('admin_panel.import');
    });
    Route::get('set_and_get_picture',function (){
        return view('admin_panel.photo');
    })->name('get_and_set_picture');
    Route::post('set_picture/{withName}','AdminController@set_file')->name('admin_set_picture');
    Route::post('get_picture/','AdminController@get_file')->name('admin_get_picture');
    Route::get('get_picture_with_link/{link}','AdminController@get_file_with_link')->where('link', '.*')->name('admin_get_picture_with_link');

    Route::post('import','AdminController@import');

    Route::get('download_order/{order}',"AdminController@export_one")->name('download_order');
    Route::get('upload_order/{order}',function (\App\Order $order){return view('admin_panel.import_one',['order'=>$order]);})->name('upload_order');
    Route::post('upload_order/{order}',"AdminController@import_one")->name('upload_order');



});
Route::group(['middleware' => ['auth','verified']], function () {
    //Route::get('/home', 'UserController@index')->name('home');
    Route::get('home','HomeController@index')->name('home');
    Route::get('search','ArtController@search')->name('search');
    Route::post('editUser','UserController@update');
    Route::get('designs','ArtController@index_templates')->name('arts');
    Route::get('design/{art}','ArtController@create_show')->name('art');
    Route::post('design/{art}','OrderController@create')->name('createorder');

    Route::get('artworks','ArtController@index_ctemplates')->name('editpictures');
    Route::get('yourAds',function (){
        return view('ads');
    });
    Route::get('upgradeAccount','UserController@showUserType')->name('upgradeAccount');
    Route::get('savedOrders','ArtController@showSaves');
    Route::get('tickets','TicketController@index');
    Route::post('createticket','TicketController@create')->name("createticket");
    Route::get('bookmark/{art}','UserController@bookmark')->name('bookmark');
    Route::get('payment/upgrade_account_to/{for}','PaymentController@create_payment_upgrade_account');
    Route::get('verify','PaymentController@verify');
    Route::get('get_order_answer/{user}/order/{order}','OrderController@get_order_answer')->name('get_order_answer');
    Route::get('download/{temp}',"OrderController@download");
    Route::post('order/cancel/{order}',"OrderController@delete");
    Route::post('set_notification_read','UserController@set_notification_read');
    Route::post('set_ticket_read','UserController@set_ticket_read');
    Route::post('get_order_token','OrderController@get_order_token');
    Route::post('get_download_link','OrderController@get_download_link');
    Route::post('get_ad_page','OrderController@get_ad_page');


});

Auth::routes();
Route::get('sitemap.xml','SeoController@sitemap');
/*
Route::get("cookie",function (){
   return \Illuminate\Support\Facades\Cookie::get();
});*/
/*Route::get('set_arr',function (){
   foreach (\App\Category::all() as $category){
       $category->arrangement = $category->id;
       $category->save();
   }
    foreach (\App\Art::all() as $category){
        $category->arrangement = $category->id;
        $category->save();
    }
});*/
Route::get('fix_img',function (){

    $arts = \App\Art::all();
    $files = Storage::disk('local')->allFiles('public');
    $is_changed = false;
    foreach ($arts as $art){
        $new_path = find_new_path($art->pro_image_link,$files);
        if($new_path){
            $art->pro_image_link = $new_path;
            $is_changed = true;
        }
        //dump($new_path);
        $new_path = find_new_path($art->after_image_link,$files);
        if($new_path){
            $art->after_image_link = $new_path;
            $is_changed = true;
        }
        if($is_changed) {$art->save();}
    }






});

function find_new_path($img,$files){
    if(Storage::exists('public/'.$img)) {
        echo $img.'<br>';
        return false;
    }else{
        echo '*************************'.$img.'<br>';
    }
    $matches = null;
    preg_match('/.+\/(.+)$/',$img,$matches);
    $file_name = $matches[1];
    $new_file_path = preg_grep("/.+${file_name}$/", $files);
    dump($new_file_path);

    if(!empty($new_file_path) and count($new_file_path) === 1  ){
         dump($new_file_path);
        return substr(array_values($new_file_path)[0],7);

    }else{
        return false;
    }
}


