<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Art;
use App\Category;
use App\dataIdManager;
use App\Jobs\DeleteOrder;
use App\Order;
use App\Tag;
use App\User;

/*use Composer\Package\Archiver\ZipArchiver;*/

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class OrderController extends Controller
{


    public function create(Request $request, Art $art)
    {
        $message = '';
        $alert_class = '';
        if (Gate::denies('create_order')) {
            $message = __("Your order could not be created");
            $alert_class='error';
            return redirect()->back()->with(['message'=>$message,'alert-class'=>$alert_class]);
        };
        $qs = ['order_token' => 'required'];
        foreach ($art->questions as $q) {
            $qs[$q->name] = $q->rules;
        }

        $request->validate(
            $qs
        );
        $user_id = Auth::user()->id;
        $token = $request->input('order_token');

        if (cache()->has("creat_order_art_{$request->input('art_id')}_user_{$user_id}_token_{$token}")) {

            $order_time = Carbon::createFromTimeString(cache()->get("creat_order_art_{$request->input('art_id')}_user_{$user_id}_token_{$token}"));


            if ($order_time <= Carbon::now()->addSeconds(-12)) {

                $order = new Order();
                $order->status = "not completed";
                $order->name = $art->category->name . ' ' . $art->title;
                $order->user_id = Auth::user()->id;
                $order->art_id = $art->id;
                //$order->answers = json_encode($request->all());
                $order->order_image = '';
                $order->save();
                foreach ($art->questions as $q) {
                    $a = new Answer();
                    $a->question_id = $q->id;
                    $a->order_id = $order->id;

                    if ($q->type !== "file") {
                        $a->value = $request->input($q->name);
                    } else {
                        $uploadedFile = $request->file($q->name);
                        if ($uploadedFile->isValid()) {
                            $file_path = Storage::put('order/images', $uploadedFile);
                            $a->value = $file_path;

                        }
                    }
                    $a->save();
                }
                $message =__("Your order created successfully");
                $alert_class ='success';

            } else {
                $message =  __("Something went wrong");
                $alert_class ='error';
            }
        } else {
            $message =  __("Something went wrong");
            $alert_class ='error';
        }

        return redirect()->back()->with(['message'=>$message,'alert-class'=>$alert_class]);
        //return redirect()->route('home');
    }


    public function get_order_token(Request $request)
    {
        if (!$request->ajax())
            return abort(404);

        $token = Str::random(32);
        $user_id = Auth::user()->id;
        cache()->put("creat_order_art_{$request->input('art_id')}_user_{$user_id}_token_{$token}", Carbon::now(), 1200);
        $data = ['token' => $token];

        return response()->json($data);
    }


    public function delete(Order $order)
    {
        $message = '';
        $alert_class = '';
        if ($order->user_id === Auth::user()->id and $order->status == "not completed") {
            $order->forceDelete();
            $message = __("Your order canceled successfully");
            $alert_class = 'success';
        }
        return redirect()->back()->with(['message'=>$message,'alert-class'=>$alert_class]);

    }

    public function get_order_answer(User $user, Order $order)
    {
        if (empty($order->order_image)) {
            return redirect()->home();
        }
        if (!cache()->has($order->order_image)) {
            $url = 'download/' . Str::random(20);
            cache()->put($url, $order->order_image, 86400);
            cache()->put($order->order_image, $url, 86400);

        } else {
            $url = cache()->get($order->order_image);
        }
        cache()->put(route('get_order_answer', [Auth::user(), $order]), ['time' => Carbon::now(), 'url' => $url], 20);
        return view('panel.download');
    }

    public function get_download_link(Request $request)
    {
        $data = cache()->get(request()->headers->get('referer'));
        if (Carbon::createFromTimeString($data['time']) <= Carbon::now()->addSeconds(-12))
            return url($data['url']);
        return abort(419);
    }

    public function download($temp)
    {
        $path = cache()->get("download/$temp");
        $order = Order::where('order_image', $path)->first();
        if (!$order->exists or empty($path)) {
            return redirect()->route('home');
        }
        preg_match("/\.(\S+)$/i", $path, $matches);

        $ext = $matches[1];
        $file_name = $order->art->category->name . ' ' . $order->art->title . '.' . $ext;
        if ($order->status !== 'received') {
            DeleteOrder::dispatch($order)->delay(86400);
            $order->status = 'received';
            $order->save();
        }

        return Storage::download($path, $file_name);
    }

    public function get_ad_page(Request $request)
    {
        return view('panel.ad', ['confirm_type' => $request->input('confirmType'), 'form' => $request->input('form'), 'text' => $request->input('text')]);
    }


}
