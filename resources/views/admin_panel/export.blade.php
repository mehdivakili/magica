@extends('voyager::master',['page_title'=>'گرفتن سفارشات به صورت اکسل'])
@section('page_title')
    گرفتن سفارشات به صورت اکسل
@stop

@section('content')
    <div class="page-content">
        <h3>طراحی گرافیک</h3>
        @foreach ($category as $c)
            <a download class="btn btn-primary" href="export/{{$c->slug}}">{{$c->name}}</a><br>
        @endforeach
        <h3>ویرایش تصاویر</h3>
        @foreach ($category2 as $c)
            <a download class="btn btn-primary" href="export/{{$c->slug}}">{{$c->name}}</a><br>
        @endforeach
    </div>
@stop
