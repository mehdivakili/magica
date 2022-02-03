@extends('layouts.app',['page_title'=>'tickets'])
@section('content')
    <div class="ticket-panel">
        @include('widget.div-style-start',['classes'=>'new-ticket', 'title'=>__("New ticket"),'description'=>description('new-ticket')])
        <form method="post" action="{{route('createticket')}}">
            @csrf
            <input id="ticket_title" type="text" class="form-control col-12"
                   placeholder="{{ __('Ticket title') }}"
                   name="ticket_title" required>
            <textarea id="ticket_description" class="form-control col-12 available" style=""
                      placeholder="{{ __('Ticket description') }}"
                      name="ticket_description" required></textarea>
            <div class="d-flex justify-content-end" style="width: 100%">
                <button type="submit" class="btn btn-gray">{{__("Send")}}</button>
            </div>
        </form>

        @include('widget.div-style-end')
        @include('widget.div-style-scroll-start',["classes"=>"your-tickets","title"=>__("Your tickets"),"height_depend"=>"available","height_px"=>167,'info'=>false])
        @empty($user->tickets->first())
            <p class="no-item">{{__("You don't have any ticket")}}</p>
        @else
        <ul class="tickets">

                @foreach($tickets as $ticket)
                    <li data-toggle="modal" data-target="#ticket{{$loop->index}}" data-id="{{$ticket->id}}"
                        class="{{types(__($ticket->status))}} justify-content-between"><p>{{$ticket->title}}</p>
                        <span><span>{{__($ticket->status)}}</span></span></li>


                    <div class="modal fade" id="ticket{{$loop->index}}" tabindex="-1" role="dialog"
                         aria-labelledby="editUserModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">

                            <div class="modal-content style-div">
                                <div class="style-div-extra-20">
                                    <div class="modal-body">
                                        <h3>{{$ticket->title}}</h3>
                                        <p class="description">{{$ticket->description}}</p>
                                        <div class="style-div-extra">
                                            <div class="style-div-extra"><p
                                                    class="answer style-div">@if(!empty($ticket->answer)){{$ticket->answer}}@else{{__("not answered")}}@endif</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end" style="width: 100%">
                                            <button class="btn btn-gray" data-dismiss="modal">{{__("Close")}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                @endforeach

        </ul>
        @endempty
        @include('widget.div-style-end')
    </div>
@stop
