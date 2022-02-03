<div class="download-panel style-div">
    <div class="style-div">
        <div class="timer"></div>
        <div style="padding-bottom: 18px">@include('svg.download_text')</div>
        <a class="btn-off btn" style="margin-top: 10px;width: 100%" @if($confirm_type === 'form') target="{{$form}}" @endif style="width: 100%">{{__($text ?? '')}}</a>
    </div>
</div>
<script src="{{url('js/jquery.countdown360.js')}}"></script>
<script src="{{get_js_link('ad-'.$confirm_type)}}"></script>

