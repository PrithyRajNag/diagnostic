
<div id="main">
    <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
        <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="font-weight: 700"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
{{--                <li class="dropdown nav-icon">--}}
{{--                    <a href="#" data-bs-toggle="dropdown"--}}
{{--                       class="nav-link  dropdown-toggle nav-link-lg nav-link-user">--}}
{{--                        <div class="d-lg-inline-block">--}}
{{--                            <i data-feather="bell"></i>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">--}}
{{--                        <h6 class='py-2 px-4'>Notifications</h6>--}}
{{--                        <ul class="list-group rounded-none">--}}
{{--                            <li class="list-group-item border-0 align-items-start">--}}
{{--                                <div class="avatar bg-success me-3">--}}
{{--                                    <span class="avatar-content"><i data-feather="shopping-cart"></i></span>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <h6 class='text-bold'>New Order</h6>--}}
{{--                                    <p class='text-xs'>--}}
{{--                                        An order made by Ahmad Saugi for product Samsung Galaxy S69--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

                <li class="dropdown nav-icon me-2">
                    @if(array_intersect(['setting.create'],\Illuminate\Support\Facades\Session::get('permissionTitle')) == ['setting.create'])
                        <a href="{{route('setting.create')}}">
                            <div class="d-lg-inline-block">
                                <i class="settings" data-feather="settings" ></i>
                            </div>
                        </a>
                    @endif


{{--                    <a href="{{route('setting.create')}}" data-bs-toggle="dropdown"--}}
{{--                       class="nav-link dropdown-toggle nav-link-lg nav-link-user">--}}
{{--                        <div class="d-lg-inline-block">--}}
{{--                            <i data-feather="mail"></i>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                        <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>--}}
{{--                        <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>--}}
{{--                        <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="log-out"></i> Logout</a>--}}

{{--                    </div>--}}
                </li>

                <li class="dropdown">
                    <a href="#" data-bs-toggle="dropdown"
                       class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        @if(Helper::profile() != null)
                            <div class="avatar me-1">
                                @if(Helper::profile()['image'] != null)
                                    <img src="{{asset('storage/images/'. Helper::profile()['image'])}}" alt="" srcset="">
                                @else
                                    <img src="{{asset('assets/images/avatar.png')}}"
                                @endif
                            </div>
                            <div class="d-none d-md-block d-lg-inline-block" style="font-family: Garamond;font-size: 16px">Hi, {{ ucwords(Helper::profile()['name']) ?? '' }} !</div>
                        @else
                            <div class="avatar me-1">
                                    <img src="{{asset('assets/images/avatar.png')}}">
                            </div>

                            {{--                        <div class="d-none d-md-block d-lg-inline-block">Hi, {{ucwords($profileName->where('user_id', auth()->user()->id ?? '')->pluck('full_name')->first())}} !</div>--}}
                            <div class="d-none d-md-block d-lg-inline-block">Hi</div>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
{{--                        <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>--}}
{{--                        <a class="dropdown-item " href="#"><i data-feather="mail"></i> Messages</a>--}}
{{--                        <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>--}}

{{--                        @if(Auth::user()->uuid != null ?? '' )--}}
                        @if(\App\Helpers\Helper::showProfile()['uuid'] != null ?? '' )
                            <a class="dropdown-item" href="{{ route('profile.show', Helper::showProfile()['uuid'])}}"><i data-feather="eye"></i> View Profile</a>
                        @else
                            <a class="dropdown-item" href="{{route('profile.edit', Auth::user()->uuid ?? '')}}"><i data-feather="edit-2"></i>Edit Profile</a>


                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-content container-fluid">
