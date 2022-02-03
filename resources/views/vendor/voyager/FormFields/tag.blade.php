@php
    $tags = \App\Tag::TagSelected(isset($data)?$data : $dataTypeContent);
    $selected_tags = isset($data)?$data->tags : $dataTypeContent->tags;


@endphp
@if($view === 'browse' or $view === 'read')
    <div>
        @foreach($selected_tags as $tag)
            {{$tag->title}} @if(!$loop->last) , @endif

        @endforeach

    </div>
@else
    @php $id = rand() @endphp

    <select id="{{$id}}" name="{{ $row->field }}[]" data-name="{{ $row->display_name }}" type-select="tags" class="form-control" multiple="multiple">
        @foreach($tags as $tag)
            <option @if($tag->selected) selected @endif value="{{$tag->name}}">{{$tag->title}}</option>

        @endforeach
    </select>
@endif
