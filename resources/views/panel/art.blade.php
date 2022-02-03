@extends('layouts.app',['page_title'=>'Personalizing order'])
@section('content')
    <div class="order-panel">

        @include('widget.div-style-scroll-start',['title'=>__("Personalizing order"), 'classes'=>'form','description'=>description('art'),'bookmark'=>true])
        <ul>
            <form method="post" onsubmit="return submittedFirst" action="{{route('createorder',[$art])}}" enctype="multipart/form-data">
                @csrf
                @foreach($art->questions as $q)
                    @include('widget.questions.'.$q->type,['name'=>$q->name,"ph"=>$q->title])
                @endforeach
                <div class="form-group d-flex justify-content-start privacy_policy_container">
                    <label class="">
                        <input id="privacy_policy" type="checkbox" class="privacy_policy" value="privacy_policy" required>
                        <span class="privacy_policy_style gray"></span>
                        <span class="privacy_policy_style gradient"></span>

                    </label>
                    <p class="privacy_policy_text">{{__("I read")}} <span class="privacy_policy_description" data-toggle="modal" data-target="#privacy_policy_modal">{{__("privacy policy")}}</span> {{__("and accept it")}}</p>

                </div>
                <div class="form-group d-flex justify-content-end">
                    <a class="btn btn-gray" style="margin-left: 20px; width: 130px"
                       href="{{route('arts')}}">{{__("Cancel")}}</a>
                    <button id="form_submin_button" data-id="{{$art->id}}" type="submit" style="width: 130px"
                            class="btn btn-gray">{{__("Submit order")}}</button>

                </div>

            </form>
        </ul>
        @include('widget.div-style-end')
        <div class="image-bg available">
            <span class="btn-gray btn-back"> {{__("With Edit")}}</span>
            <span class="btn-gray btn-preview"> {{__("Preview")}}</span>
            <img class="after-image" src="{{furl($art->after_image_link)}}">
            <img class="pro-image" src="{{furl($art->pro_image_link)}}">
            @empty($art->description)@else<p class="img-description">{{$art->description}}</p>@endempty


        </div>
    </div>
    <div class="modal fade" id="privacy_policy_modal" tabindex="-1" role="dialog"
         aria-labelledby="editUserModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">

            <div class="modal-content style-div">
                <div class="style-div-extra-20">
                    <div class="modal-body">
                        <h3>{{__("privacy policy")}}</h3>
                        <p class="description">
                            {!!description("privacy policy")!!}
                        </p>
                        <div class="d-flex justify-content-end" style="width: 100%">
                            <button class="btn btn-gray" data-dismiss="modal">{{__("Close")}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop

