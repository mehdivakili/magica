@extends('layouts.app')
@section('content')
    @include('widget.div-style-start',['classes'=>'art-panel available','style'=>'','info_title'=>__('designs'),'description'=>description('designs')])
    @empty($categories)
        <p></p>
    @else
        <div class="arrow-right">@include('svg.arrow-right')</div>
        <div class="arts-btn-con">
            <div class="arts-btn-con-extra">
                <ul id="arts-btn">
                    <div class="max-content">
                        @foreach($categories as $category)

                            <li class="style-div btn btn-ul" @if($loop->first) first
                                @endif category="{{$category->slug}}">{{$category->name}}</li>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>
        <div class="arrow-left">@include('svg.arrow-left')</div>
        @foreach($categories as $category)
            @include('widget.div-style-scroll-start',['classes'=>'column '.$category->slug,'height_depend'=>'available','height_px'=>-53, 'bg'=>'rgba(0,0,0,0)', 'info'=>false,'name'=>'column'])
            <ul>

                @foreach($category->arts as $art)
                    <li class="art-con" style="display: none">
                        <a href="{{route('createorder',['art'=>$art])}}">
                            <img class="img-fluid" link="{{Voyager::image($art->thumbnail('resize-500', 'pro_image_link'))}}">
                        </a>
                        <div class="banner-content" href="{{url('art/'.$art->name)}}">
                            <a href="{{route('createorder',['art'=>$art])}}"
                               style="position: absolute; width: 100%;height: 100%; top: 0; left: 0"></a>
                            <button class="icon"
                                    onclick="bookmark('{{route('bookmark',[$art])}}',this)">@empty($bookmarks[$art->id])@include('svg.bookmark-white')@else @include('svg.bookmark-fill') @endempty</button>
                        </div>
                    </li>
                @endforeach
            </ul>
            @include('widget.div-style-end')
        @endforeach
    @endempty
    @include('widget.div-style-end')

@stop
