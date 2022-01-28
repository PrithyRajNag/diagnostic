@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Notice</h3>
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
                            <form class="form form-vertical" id="editForm" action="{{route('notice.update',$notice->uuid)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2 d-flex align-items-center">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{$notice->title}}"
                                                       placeholder="Title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{$notice->description}}</textarea>
                                            </div>
                                            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="start_date" class="mb-2 d-flex align-items-center">{{'Start Date'}}</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{$notice->start_date}}"
                                                       placeholder="start date">
                                            </div>
                                            <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="end_date" class="mb-2 d-flex align-items-center">{{'End Date'}}</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{$notice->end_date}}"
                                                       placeholder="end date">
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
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="1" {{($notice->status == "1") ? "checked" : ""}}>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="0" {{($notice->status == "0") ? "checked" : ""}}>
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <b><label for="document" class="mb-2">Uploaded Document</label></b>
                                            <p>
                                                @if($notice->document != null)
                                                    <iframe src="{{asset("storage/documents/".$notice->document)}}" width="100%" height="500px">
                                                    </iframe>
                                                @else
                                                    {{ __("No Files Available") }}
                                                @endif
                                            </p>
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

        $("#editForm").validate({
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
