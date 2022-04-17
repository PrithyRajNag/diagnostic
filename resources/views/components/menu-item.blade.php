{{--@dd(Arr::flatten($subMenu))--}}
{{--@dd(Request::segments()[0])--}}
{{--@dd(Request::segments()[0])--}}
@if($hasSub == '')
    <li class="sidebar-item {{$hasSub ? 'has-sub' : ''}} {{URL::current() == $link ||  Request::segments(1)[0] == explode("/", $link)[3] ? 'active' : ''}}">
@else
    <li class="sidebar-item {{$hasSub ? 'has-sub' : ''}} {{URL::current()==$link || in_array(URL::current(), Arr::flatten($subMenu)) ||in_array(Request::segments()[0], Arr::flatten($subMenu)) ? 'active' : ''}}">
        @endif
        <a href="{{ $link }}" class="sidebar-link">
            <i class="icon-color" data-feather="{{ $sideIcon }}" width="20"></i>
            <span>{{ $title }}</span>

        </a>
        @if($hasSub)
            @foreach($subMenu as $menu)
                {{--            @dd(Request::segments(1)[0] == explode("/", $menu['link'])[3])--}}
                {{--            @dd(in_array(URL::current(), Arr::flatten($subMenu)))--}}
                <ul class="submenu {{in_array(URL::current(), Arr::flatten($subMenu))  ? 'active' : ''}}">
                    {{--            @dd($menu['link'])--}}
                    {{--            @dd((Str::contains($menu['link'].'/', Request::segments(1)[0].'/')) == true   ? 'active' : '')--}}
                    {{--        <ul class="submenu {{(Str::contains($menu['link'].'/', Request::segments(1)[0].'/')) == true   ? 'active' : ''}}">--}}

                    @if(array_intersect(array($menu['permission']),Session::get('permissionTitle')) == array($menu['permission']))
                        <li >
                            <a href="{{ url($menu['link'])}}">{{$menu['title']}}</a>
                        </li>
                    @endif
                </ul>
            @endforeach
        @endif
    </li>
