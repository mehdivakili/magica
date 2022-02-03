@extends('voyager::master')
@section('page_title')
    آپلود سفارشات
@stop

@section('content')
    <form method="post" class="panel-body" action="./import" enctype="multipart/form-data">
        @csrf

            <input type="file" class="form-control col-10" name="files[]" multiple>
        <div class="panel-footer">
            <input type="submit" class="btn btn-primary col-2" value="import">
        </div>
    </form>
@stop


