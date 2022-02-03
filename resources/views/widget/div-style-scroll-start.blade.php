<div class="style-div-scroll {{$classes ?? '' ?? ''}}" style="@if(!empty($bg))background-color:{{$bg}}; border-radius: 0; padding:0; {{$style??''}}  @endif">
    <div class="justify-content-between row" style="margin: 0; position: relative; padding-left: 20px">

        @php $id =rand()@endphp
        @if(!empty($title))<h3>{{ $title}}</h3>@endif
        @if($bookmark ?? false === true)<div class="d-flex flex-row-reverse">@endif
        @if($info ?? '' !== false)<div class="info-icon @if(empty($title)) abs-info @endif" data-toggle="modal" data-target="#info{{$id}}">@include('svg.info')</div>

            <div class="modal fade" id="info{{$id}}" tabindex="-1" role="dialog" aria-labelledby="editUserModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">

                    <div class="modal-content style-div">
                        <div class="style-div-extra-20">
                            <div class="modal-body">
                                @if(!empty($title) or !empty($info_title))<h3>{{ $info_title??$title}}</h3>@endif
                                <p class="description">
                                    {{$description ?? ""}}
                                </p>
                                <div class="d-flex justify-content-end" style="width: 100%">
                                    <button class="btn btn-gray" data-dismiss="modal">{{__("Close")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>


            @endif

        @if($bookmark ?? false === true)
        <button class="bookmark-icon" onclick="bookmarkGray('{{route('bookmark',[$art])}}',this)">@if($is_bookmarked)@include('svg.bookmark-fill-gray')@else @include('svg.bookmark-gray') @endif</button>
        @endif
            @if($bookmark ?? false === true)</div>@endif
    </div>


{{--</div>--}}
