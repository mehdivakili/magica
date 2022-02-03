@extends('voyager::master')
@section('page_title')
    آپلود سفارش
@stop
@section('page_header')
    <div class="d-flex row">
        <a class="btn badge-warning btn-lg" href="../orders">بازگشت به لیست</a>
        <a class="btn badge-primary btn-lg" href="../orders/{{$order->id}}">مشاهده سفارش</a>
    </div>

@stop
@section('content')

    <form method="post" class="panel-body" action="{{route('upload_order',[$order])}}" enctype="multipart/form-data">
        @csrf

        <input type="file" class="form-control col-10" name="file" multiple>
        <div class="panel-footer">
            <input type="submit" class="btn btn-primary col-2" value="import">
        </div>
    </form>
@stop
