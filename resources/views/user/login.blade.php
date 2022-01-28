<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>

<body>
<div id="auth">
    <div class="container">
        @if($setting != Null)
        <h1 class="text-center" style="color: darkgoldenrod; font-family: Apple">{{ $setting->title ?? "" }}</h1>
        @endif
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        @if(session('success'))
                            <x-alert type="success" message="{{session('success')}}"></x-alert>
                        @endif
                        <div class="text-center mb-5">
                            <h3>Sign In</h3>
                            <p>Please sign in to continue.</p>
                        </div>
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <x-alert type="danger" message="{{$error}}"></x-alert>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <label for="email">Email</label>
                                <div class="position-relative">
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Password</label>
                                    <a href="{{ route('password.request') }}" class='float-end'>
                                        <small>Forgot password?</small>
                                    </a>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class='form-check clearfix my-4'>
                                <div class="checkbox float-start">
                                    <input type="checkbox" id="checkbox1" name="active" value="1" class='form-check-input'>
                                    <label for="checkbox1">Remember me</label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button type="submit" class="btn btn-primary float-end">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
