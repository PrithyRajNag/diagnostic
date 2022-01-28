<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport csrf-token" content="width=device-width, initial-scale=1 {{ csrf_token() }}">
    <title>Sign Up</title>
    <link href="{{asset('assets/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/chartjs/Chart.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>
<body>
<div id="auth">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <h3>Register New User</h3>
                        </div>
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control"
                                               name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </diV>
                            <div class="row">
                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <label for="role_id" class="mb-2">Role Name</label>
                                        <select name="role_id[]" id="roles" class="form-control select2 roles" multiple required>
                                            <option hidden value="{{ old('role_id') }}"></option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </diV>
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
<script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
    $(".select2").select2({
        allowClear: true
    })


</script>
</body>
</html>

