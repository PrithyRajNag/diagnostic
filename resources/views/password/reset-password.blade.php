<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>

<body>
<div id="auth">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card py-4">
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
{{--                                <x-alert type="danger" message="{{$error}}"></x-alert>--}}
{{--                                <div class="alert alert-light-danger alert-dismissible show fade" id="alert"><i data-feather="star"></i>--}}
{{--                                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                                        <h6 class="text-light-danger">{{ $error }}</h6> <span data-bs-dismiss="alert">&times;</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="alert alert-light-danger alert-dismissible show fade" id="alert"><i data-feather="star"></i>
                                    {{ $error }} <span class="float-end" data-bs-dismiss="alert">&times;</span>
                                </div>
                            @endforeach
                        @endif
                        <div class="text-center mb-5">
                            <h3>Reset Password</h3>
                            <p>Please enter your email & provide new password.</p>
                        </div>
                        <form action="{{route('password.update')}}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left">
                                <label for="email">Email</label>
                                <div class="position-relative">
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                                <input type="hidden"  name="token" value="{{ $token }}">
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Password</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Confirm Password</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button class="btn btn-primary float-end">Submit</button>
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
