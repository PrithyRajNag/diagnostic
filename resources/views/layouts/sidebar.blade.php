<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active sidebar-color">
        <div class="sidebar-header">
            @if(Helper::logo() != null)
                @if(Helper::logo()['logo'] != null)
                    <img src="{{asset("storage/logos/".Helper::logo()['logo'])}}" alt="" srcset="" style="">
                @else
                    <img src="{{asset("assets/images/logo_ial-02-01.png")}}" alt="" srcset="" style="">
                @endif
            @else
                <img src="{{asset("assets/images/logo_ial-02-01.png")}}" alt="" srcset="" style="">
            @endif
        </div>
        <div class="sidebar-menu">
            <ul class="menu" style="margin-top: 0px">
                <li class='sidebar-title'>Main Menu</li>
                @foreach(Helper::menuList() as $menu)
                    @if(array_intersect(array($menu['permission']) , Session::get('permissionTitle')) ==   array($menu['permission']))
                        <x-menu-item sideIcon="{{$menu['sideIcon']}}" title="{{$menu['title']}}"
                                     link="{{$menu['link']}}" permission="{{$menu['permission']}}"
                                     hasSub="{{$menu['hasSub']}}" :subMenu="$menu['subMenu']"></x-menu-item>
                    @endif
                @endforeach
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
