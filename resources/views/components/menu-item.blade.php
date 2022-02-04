
<li class="sidebar-item {{$hasSub ? 'has-sub' : ''}} {{URL::current()==$link || in_array(URL::current(), Arr::flatten($subMenu)) ? 'active' : ''}}">
   <a href="{{ $link }}" class="sidebar-link ">
       <i class="icon-color" data-feather="{{ $sideIcon }}" width="20"></i>
       <span>{{ $title }}</span>

   </a>
   @if($hasSub)

       <ul class="submenu {{in_array(URL::current(), Arr::flatten($subMenu)) ? 'active' : ''}}">
           @foreach($subMenu as $menu)
               @if(array_intersect(array($menu['permission']),Session::get('permissionTitle')) == array($menu['permission']))
                   <li>
                       <a href="{{ url($menu['link'])}}">{{$menu['title']}}</a>
                   </li>
               @endif
           @endforeach
</ul>
@endif

</li>
