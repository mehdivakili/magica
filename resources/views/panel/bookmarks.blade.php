@extends('layouts.app',['page_title'=>'saved orders'])
@section('content')
    <div class="bookmark-panel available style-div" style="padding-left: 3px; min-height: 535px">
    @include('widget.div-style-scroll-start',['classes'=>'column','height_depend'=>'available','height_px'=>20, 'bg'=>'rgba(0,0,0,0)', 'info'=>false,'name'=>'column'])
    <ul>
        @foreach($arts as $art)
            <li class="art-con" style="display: none">
                <a href="{{route('createorder',['art'=>$art])}}">
                    <img class="img-fluid" link="{{furl($art->pro_image_link)}}">
                </a>
                <div class="banner-content">
                    <a href="{{route('createorder',['art'=>$art])}}" style="position: absolute; width: 100%;height: 100%; top: 0; left: 0"></a>
                    <button class="icon" onclick="bookmark('{{route('bookmark',[$art])}}',this)">@include('svg.bookmark-fill')</button>
                </div>
            </li>
        @endforeach
    </ul>
    </div>
    @include('widget.div-style-end')

@stop
