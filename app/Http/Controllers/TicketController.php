<?php

namespace App\Http\Controllers;

use App\dataIdManager;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets;
        $ticket_read = new dataIdManager('ticket_read');
        $ticket_read = $ticket_read->get_all();

        foreach ($tickets as $key=>$ticket){
            if(isset($ticket_read[$ticket->id])){
                $tickets[$key]->status = "read";
            }elseif (!empty($ticket->answer)){
                $tickets[$key]->status = "answered";
            }else{
                $tickets[$key]->status = "not answered";
            }

        }


        return view('panel.tickets',['user'=>$user,'tickets'=>$tickets,'js'=>['ticket']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $title = $request->input('ticket_title');
        $desc = $request->input('ticket_description');
        Auth::user()->tickets()->create(['title'=>$title,'description'=>$desc,'status'=>'not answered']);
        $message =  __("Your Ticket created successfully");
        $alert_class =  'success';
        return redirect()->back()->with(['message'=>$message,'alert-class'=>$alert_class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
