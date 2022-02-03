<?php

namespace App\Http\Controllers;

use App\dataIdManager;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified'])->except(['varify_phone_number_create','varify_phone_number']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $notification_new_date = Carbon::now()->addWeek(-1);
        $notifications = Notification::where('user_id',Auth::user()->id)->orWhere('user_id',0)->orderBy('updated_at','DESC')->get();
        $notification_read = new dataIdManager('notification_read');
        $notification_read = $notification_read->get_all();

        foreach ($notifications as $key=>$notification){
            if(isset($notification_read[$notification->id])){
                $notifications[$key]->status = "read";
            }else{
                $notifications[$key]->status = "new";
            }

        }
        return view('panel.home',['user'=>Auth::user(),'notifications'=>$notifications,'js'=>['home']]);

    }
    public function varify_phone_number(Request $request)
    {
        return view('pnv');
    }
    public function varify_phone_number_create(Request $request){

       $val = $request->validate( ['name' =>'required|string|max:255',
            'phone_number' => 'required|numeric|unique:users']);

       if(!cache()->has($request->input('phone_number'))){
       $token = rand(100000, 999999);

        cache()->put($request->input('phone_number'), $token, 120);
        $this->send_sms($request->input('phone_number'), $token);
    }

    return view('pnv',['name'=>$request->input('name'),'phone_number'=>$request->input('phone_number')]);
}
private function send_sms($phone_number,$token){
    try{
        $api = new KavenegarApi("345554796F2F7A4A324D7234534132463959424D4B2B685A4A58654E6C58466F425637716E4633426B64733D");
        $receptor = $phone_number;
        $token2 = "";
        $token3 = "";
        $template = "phonenumberverify";
        $type = "sms";//sms | call
        $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
        if($result){
            return true;
        }
    }
    catch(ApiException $e){
        return false;
    }
    catch(HttpException $e){
        return false;
    }
}


}
