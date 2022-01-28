@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Notice</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('notice.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" id="createForm" action="{{route('notice.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                                       placeholder="Title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description" class="mb-2">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                                            </div>
                                            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="start_date" class="mb-2">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                                       placeholder="Start Date">
                                            </div>
                                            <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="end_date" class="mb-2">End Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                                       placeholder="End Date">
                                            </div>
                                            <span class="text-danger">@error('end_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="document" class="mb-2">Document</label>
                                                <input type="file" class="form-control custom-file" id="document" name="document" value="{{ old('document') }}">
                                            </div>
                                            <span class="text-danger">@error('document'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="active"
                                                           value="1" @if( old('status')) == "1" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="inactive"
                                                           value="0" @if( old('status')) == "0" ? 'checked' : '' @endif
                                                    required>
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
                title: "required",
                start_date : "required",
                end_date : "required",
                status : "required",
                document :  "mimes:jpeg,png,doc,docs,pdf",
            },
            messages:{
                title: "Title is required",
                start_date: "Start Date is required",
                end_date: "End Date is required",
                status: "Status is required",
            }
        });
    </script>
@endpush
