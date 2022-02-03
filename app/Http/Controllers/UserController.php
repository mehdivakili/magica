<?php

namespace App\Http\Controllers;

use App\Art;
use App\dataIdManager;
use App\Jobs\DeleteNotification;
use App\Notification;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\True_;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class UserController extends Controller
{
    public function showUserType()
    {
        $message =  __("this page will build soon");
        $alert_class = '';
        return redirect()->back()->with(['message'=>$message,'alert-class'=>$alert_class]);

        //return view('panel.update_account');
    }

    public function bookmark(Art $art)
    {
        $message = "";
        $user = Auth::user();
        $bookmarks = new dataIdManager($user, false, 'bookmarks');
        $result = $bookmarks->toggle_id($art->id);
        if ($result) {
            $message = "added successfully";

        } else {
            $message = "removed successfully";
        }
        $bookmarks->save();

//        $bookmarks = json_decode($user->bookmarks, true);
//        if (isset($bookmarks[$art->id])) {
//            unset($bookmarks[$art->id]);
//            $message = "removed successfully";
//        } else {
//            $bookmarks[$art->id] = $art->id;
//            $message = "added successfully";
//        }
//        $user->bookmarks = json_encode($bookmarks);
//        $user->save();

        return $message;

    }

    public function update(Request $request)
    {
        $email_changed = false;
        $user = Auth::user();
        $request->validate([
            'name' => 'required|min:4',
            'password' => 'nullable|min:6|regex:/^[\S]+$/|confirmed',
            //.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*
            //////////for phone number system
            //'phone_number' => 'required|string|min:10|max:12|regex:/[0-9]{9}/|unique:users,id,' . $user->id,
            'email' => 'sometimes|required|email|unique:users,id,' . $user->id
        ]);

        $user->name = $request->input('name');


        /*        if( $user->phone_number !== $request->input('phone_number')) {
                    $user->phone_number = $request->input('phone_number');
                    $user->phone_number_verified = false;
                }*/

        if ($user->email !== $request->input('email')) {
            $user->email = $request->input('email');
            $user->email_verified_at = null;
            $email_changed = true;
        }
        $user->password = (!empty($request->input('password'))) ? Hash::make($request->input('password')) : $user->password;
        $user->save();
        if($email_changed) {
            $user->sendEmailVerificationNotification();
        }
        $message = __("Saved successfully");
        $alert_class = 'success';
        return redirect()->back()->with(['message'=>$message,'alert-class'=>$alert_class]);
    }

    public function set_notification_read(Request $request)
    {
        $request->validate([
            'notification_id' => 'required|numeric'
        ]);
        $notification_id = $request->input("notification_id");

        $notifications = new dataIdManager('notification_read');

        if ($notifications->add_id($notification_id)) {
            $notification = Notification::find($notification_id);
            if ($notification->user_id != 0)
                DeleteNotification::dispatch(Notification::find($notification_id))->delay(86400);
            return response('saved')->withCookie($notifications->save());
        }

        return response('saved')->withCookie($notifications->save());
    }

    public function set_ticket_read(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|numeric'
        ]);
        $ticket_id = $request->input("ticket_id");

        $tickets = new dataIdManager('ticket_read');
        if (!empty(Ticket::find($ticket_id)->answer)) {
            $tickets->add_id($ticket_id);
            return response('saved')->withCookie($tickets->save());
        }
        return response('not saved')->withCookie($tickets->save());

    }
}
