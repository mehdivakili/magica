@extends('layouts.app',['page_title'=>'upgrade account'])
@section('content')
    <div class="account-panel">
        <div class="basic style-div banners">

                <div class="style-div title available">

                    <span>{{__('Basic')}}</span>
                </div>
            <p class="style-div description">{{__('Monthly')}}</p>
            <p class="style-div description">{{fa_number((int)setting('account.basic_number'))}} {{__('daily order')}}</p>
{{--            <p class="style-div description">{{__('Without')}} {{__('mail system')}}</p></div>--}}
            <p class="style-div description">{{__('With')}} {{__('ads')}}</p>
{{--            <p class="style-div description">{{__('Access to VIP design')}}</p></div>--}}

                <div class="style-div cost available">
                    <p><span>{{cost(setting('account.basic_amount'))}}</span> {{__("Toman")}}</p>
                </div>

            <a class="btn btn-gradient" href='{{url('payment/upgrade_account_to/basic')}}'>{{__("Activate")}}</a>

        </div>
        <div class="general style-div banners">

                <div class="style-div title">
                    <span>{{__('General')}}</span>
                    <script defer>
                        toRes("general .title","basic .title",0,0 )


                    </script>
                </div>

            <p class="style-div description">{{__('Monthly')}}</p>
            <p class="style-div description">{{fa_number((int)setting('account.general_number'))}} {{__('daily order')}}</p>
{{--            <p class="style-div description">{{__('With')}} {{__('mail system')}}</p></div>--}}
            <p class="style-div description">{{__('Without')}} {{__('ads')}}</p>
{{--            <p class="style-div description">{{__('Access to VIP design')}}</p></div>--}}

                <div class="style-div cost">
                    <p><span>{{cost(setting('account.general_amount'))}}</span> {{__("Toman")}}</p>
                    <script defer>
                        toRes("general .cost","basic .cost",0,0 )


                    </script>
                </div>

            <a class="btn btn-gradient" href='{{url('payment/upgrade_account_to/general')}}'>{{__("Activate")}}</a>

        </div>
        <div class="advanced style-div banners">

                <div class="style-div title">
                    <span>{{__('Advanced')}}</span>
                    <script defer>
                        toRes("advanced .title","basic .title",0,0 )


                    </script>
                </div>

            <p class="style-div description">{{__('Monthly')}}</p>
            <p class="style-div description">{{fa_number((int)setting('account.advanced_number'))}} {{__('daily order')}}</p>
{{--            <p class="style-div description">{{__('With')}} {{__('mail system')}}</p></div>--}}
            <p class="style-div description">{{__('Without')}} {{__('ads')}}</p>
{{--            <p class="style-div description">{{__('Access to VIP design')}}</p></div>--}}

                <div class="style-div cost">
                    <p><span>{{cost(setting('account.advanced_amount'))}}</span> {{__("Toman")}}</p>
                    <script defer>
                        toRes("advanced .cost","basic .cost",0,0 )


                    </script>
                </div>

            <a class="btn btn-gradient" href='{{url('payment/upgrade_account_to/advanced')}}'>{{__("Activate")}}</a>
        </div>

</div>
@stop
