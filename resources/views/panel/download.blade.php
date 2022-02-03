@extends('layouts.app',['min_height'=>'550px','available'=>true, 'page_title'=>'download'])
@section('content')
{{--    <div class="download-panel style-div">
        <div class="style-div">
        <div class="timer"></div>
        <div style="padding-bottom: 18px">@include('svg.download_text')</div>
        <a class="btn-off btn" style="width: 100%">{{__("Download file")}}</a>
        </div>
    </div>--}}

    @include('panel.ad',['confirm_type'=>'download','text'=>'download'])

@stop
