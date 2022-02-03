@extends('layouts.app',['page_title'=>'home'])

@section('content')
    <div class="home-div">
        <div class="other">
            <div class="brand style-div available" style="">

                <div id="wave">@include('svg.wave')</div>
                @include('svg.magica_m')

            </div>
            <div class="d-flex account-and-notification-div">
                @include('widget.div-style-start',['classes'=>'account-div','title'=>__('Account type'),'description'=>description('account-div')])
                <div class="style-div acount">
                    <p>{{__($user->type)}}</p>
                </div>
                <a class="btn btn-gradient" href="{{url('upgradeAccount')}}">{{__('upgrade account')}}</a>
                @include('widget.div-style-end')
                @include('widget.div-style-scroll-start',['classes'=>'ticket-div','title'=>__('Notifications'),'description'=>description('notification-div')])
                @empty($notifications->first())
                    <p class="no-item">{{__("You don't have any notification")}}</p>
                @else
                    <ul class="tickets">

                        @foreach($notifications as $notification)
                            <li data-toggle="modal" data-target="#notification{{$loop->index}}"
                                data-id="{{$notification->id}}"
                                class="{{types(__($notification->status))}} justify-content-between">
                                <p>{{$notification->title}}</p>
                                <span><span>{{__($notification->status)}}</span></span></li>


                            <div class="modal fade" id="notification{{$loop->index}}" tabindex="-1" role="dialog"
                                 aria-labelledby="editUserModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered " role="document">

                                    <div class="modal-content style-div">
                                        <div class="style-div-extra-20">
                                            <div class="modal-body">
                                                <h3>{{$notification->title}}</h3>
                                                <p class="description">{{$notification->description}}</p>
                                                {{--                                                <div class="style-div-extra"> <div class="style-div-extra"> <p class="answer style-div">@if(!empty($notification->answer)){{$notification->answer}}@else{{__("not answered")}}@endif</p></div></div>--}}
                                                <div class="d-flex justify-content-end" style="width: 100%">
                                                    <button class="btn btn-gray"
                                                            data-dismiss="modal">{{__("Close")}}</button>
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
        </div>
        @include('widget.div-style-scroll-start',['classes'=>'orders-div','title'=>__('Your orders'),"height_depend"=>'4 * 1.6rem - 4*1.1rem',"height_px"=>'-12px','description'=>description('orders-div')])

        @empty($user->orders->first())
            <p class="no-item">{{__("You don't have any order")}}</p>
        @else
            <ul class="orders">

                @foreach($user->orders as $order)
                    <li class="{{types(__($order->status))}} justify-content-between">@empty($order->order_image)@else
                            <a class="d-flex justify-content-between link"
                               href="{{url("get_order_answer/$user->id/order/$order->id")}}"> @endempty
                                <p>{{$order->name}}</p><span><span>{{__($order->status)}}</span>@if($order->status == "not completed")
                                        <i class="cancel" data-toggle="modal"
                                           data-target="#cancel-order-{{$loop->index}}"
                                           aria-hidden="true">@include('svg.cancel')</i>@endif</span>@empty($order->order_image)@else
                            </a> @endempty</li>
                    <div class="modal fade" id="cancel-order-{{$loop->index}}" tabindex="-1" role="dialog"
                         aria-labelledby="editUserModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">

                            <div class="modal-content style-div">
                                <div class="style-div-extra-20">
                                    <div class="modal-body">
                                        <form action="order/cancel/{{$order->id}}" method="post">
                                            @csrf
                                            <h3>{{__("Do you want to cancel this order?")}}</h3>
                                            <div class="form-group d-flex justify-content-end" style="margin-bottom: 0">
                                                <button class="btn" data-dismiss="modal"
                                                        style="margin-left: 1.1rem">{{__("Cancel")}}</button>
                                                <button class="btn" type="submit">{{__("Delete")}}</button>
                                            </div>
                                        </form>
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

@endsection
