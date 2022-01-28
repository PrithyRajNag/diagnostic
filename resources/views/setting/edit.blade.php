@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if(session('success'))
                    <x-alert type="success" message="{{session('success')}}"></x-alert>
                @endif
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Update Application Setting</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('dashboard')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                                <form class="form form-vertical" action="{{route('setting.store')}}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Application Title</label>
                                                <input type="text" value="{{ $settings->title ?? old('title') ?? '' }}"  class="form-control" id="title" name="title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="mb-2"><span class="required">*</span> Email Address</label>
                                                <input type="email" value="{{ $settings->email ?? old('email') ?? '' }}"  class="form-control" id="email" name="email">
                                            </div>
                                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2"><span class="required">*</span> Phone Number</label>
                                                <input type="text" value="{{ $settings->phone_number ?? old('phone_number') ?? '' }}"  class="form-control" id="phone_number" name="phone_number">
                                            </div>
                                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col- mt-2">
                                            <label for="address" class="mt-2 font-weight-bolder">Address</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address['country']"
                                                       class="mb-2"><span class="required">*</span> Country</label>
                                                <input type="text" name="address[country]"
                                                       id="country" class="form-control"
                                                       value="{{ $settings->address['country'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[district]"
                                                       class="mb-2"><span class="required">*</span> District</label>
                                                <input type="text" name="address[district]" id="district"
                                                       class="form-control"
                                                       value="{{ $settings->address['district'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[upazila]" class="mb-2"><span class="required">*</span> Thana/Upazila</label>
                                                <input type="text" name="address[upazila]" id="present_upazila"
                                                       class="form-control"
                                                       value="{{ $settings->address['upazila'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[post_code]" class="mb-2"><span class="required">*</span> Post
                                                    Code</label>
                                                <input type="text" name="address[post_code]" id="present_post"
                                                       class="form-control"
                                                       value="{{ $settings->address['post_code'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line1]" class="mb-2"><span class="required">*</span> Address Line 1</label>
                                                <textarea class="form-control"
                                                          name="address[address_line1]" id="present_add1"
                                                          rows="2"
                                                          required>{{ $settings->address['address_line1'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line2]" class="mb-2">Address Line 2</label>
                                                <textarea class="form-control"
                                                          name="address[address_line2]" id="present_add2"
                                                          rows="2">{{ $settings->address['address_line2'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="favicon" class="mb-2"><span class="required">*</span> Favicon</label>
                                                <input type="file" value="{{ old('favicon') }}"  class="form-control" id="favicon" name="favicon">
                                            </div>
                                            <span class="text-danger">@error('favicon'){{ $message }}@enderror</span>
                                            <div class="form-group col-sm-6">
                                                <div id="favicon-holder"
                                                     style="width: 200px; position: relative"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="logo" class="mb-2"><span class="required">*</span> Logo</label>
                                                <input type="file" value="{{ old('logo') }}"  class="form-control" id="logo" name="logo">
                                            </div>
                                            <span class="text-danger">@error('logo'){{ $message }}@enderror</span>
                                            <div class="form-group col-sm-6">
                                                <div id="logo-holder"
                                                     style="width: 200px; position: relative"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="footer_text" class="form-label"><span class="required">*</span> Footer Text</label>
                                                <textarea class="form-control"  name="footer_text"
                                                          rows="3">{{ $settings->footer_text ?? old('footer_text') ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')

<script>

    $("#editForm").validate({
        rules:{
            title: "required",
            description : "required",
            start_date : "required",
            end_date : "required",
            document :  "mimes:jpeg,png,doc,docs,pdf",
        },
        messages:{
            title: "Title is required",
            description: "Description is required",
            start_date: "Start Date is required",
            end_date: "End Date is required",
        }
    });


    $(".select2").select2({
        allowClear: true
    })

    function onDelete(e) {
        console.log(e.value)
        document.getElementById('delForm').setAttribute('action', e.value)
    }

    $("#logo").on('change', function () {
        var imgPath = $(this)[0].value;
        var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg"|| extension === "svg") {
            if (typeof (FileReader) != "undefined") {

                var image_holder = $("#logo-holder");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "img-thumbnail"
                    }).appendTo(image_holder);
                };
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Please Select Image Only !");
        }
    });
    $("#favicon").on('change', function () {
        var imgPath = $(this)[0].value;
        var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg"|| extension === "svg") {
            if (typeof (FileReader) != "undefined") {

                var image_holder = $("#favicon-holder");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "img-thumbnail"
                    }).appendTo(image_holder);
                };
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Please Select Image Only !");
        }
    });


</script>
@endpush

