@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Test Category</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('test-category.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('test-category.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lab_id" class="mb-2 d-flex align-items-center"><span class="required">*</span> Lab Name</label>
                                                <select name="lab_id" class="form-control select2"  style="width: 100%" required>
                                                    <option hidden value=""></option>
                                                    @foreach($labs as $lab)
                                                        <option value="{{$lab->id}}">{{$lab->lab_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <span class="text-danger">@error('lab_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                                       placeholder="Title" required>
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                                                <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" required>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>

                                </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules:{
                lab_id: "required",
                title: "required",
                status:"required",

            },
            messages:{
                lab_id: "Lab Name is required",
                title: "Title is required",
                status:"Status is required",
            }
        });
        $(".select2").select2({
            allowClear: true
        })
    </script>
@endpush
