<ul class="items">

    @php

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)
        <li class="@if($options->mobile) item d-flex flex-row-reverse justify-content-between @else item row @endif">
            <div class="icon">@include('svg.'.$item->icon_class)</div>
            <a href="{{ url($item->link()) }}">{{$item->title }}</a>
        </li>

    @endforeach
    <li class="@if($options->mobile) item d-flex flex-row-reverse justify-content-between @else item row @endif">
        <div class="icon">@include('svg.exit')</div>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
    </li>
</ul>
