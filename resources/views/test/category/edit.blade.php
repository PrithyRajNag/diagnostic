@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Test Category Information</h3>
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
                            <form id="editForm" class="form form-vertical" action="{{route('test-category.update', $testCategory->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="lab_id" class="mb-2 d-flex align-items-center"><span class="required">*</span> Lab Name</label>
                                                    <select name="lab_id" class="form-select select2"  style="width: 100%" >
 @foreach($labs as $lab)
                                                            <option hidden value="{{ $lab->id }}" {{$testCategory->lab_id == $lab->id ? 'selected' : ''}}>{{$lab->lab_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span class="text-danger">@error('lab_name'){{ $message }}@enderror</span>
                                            </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ ucwords($testCategory->title) }}"
                                                       placeholder="Category Title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{ ucwords($testCategory->description) }}</textarea>
                                                <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" {{($testCategory->status == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" {{($testCategory->status == "0") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
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

