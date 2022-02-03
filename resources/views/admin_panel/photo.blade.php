@extends('voyager::master',['page_title'=>'گرفتن و قرار دادن عکس'])
@section('page_title')
    گرفتن و قرار دادن عکس
@stop

@section('content')
                               <h3>get picture</h3>
    <form action="{{route('admin_get_picture')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="text" placeholder="path" name="link">
        <input class="btn btn-primary" type="submit" value="submit">
    </form>
                               <h3>set picture with random name</h3>
    <form action="{{route('admin_set_picture',[false])}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="picture" >
        <input class="form-control" type="text" placeholder="path" name="link">
        <input class="btn btn-primary" type="submit" value="submit">
    </form>
                               <h3>set picture with custom name</h3>
    <form action="{{route('admin_set_picture',[true])}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="picture" >
        <input class="form-control" type="text" placeholder="path" name="link">
        <input class="btn btn-primary" type="submit" value="submit">
    </form>
@stop
