@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Lab Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('lab.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editForm" class="form form-vertical" action="{{route('lab.update', $lab->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lab_name" class="mb-2">Lab Name</label>
                                                <input type="text" class="form-control" id="lab_name" name="lab_name" value="{{$lab->lab_name}}"
                                                       placeholder="lab name" required>
                                            </div>
                                            <span class="text-danger">@error('lab_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="room_number" class="mb-2">Room Number</label>
                                                <input type="text" class="form-control" id="room_number" name="room_number" value="{{$lab->room_number}}"
                                                       placeholder="Room Number" required>
                                            </div>
                                            <span class="text-danger">@error('room_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address" class="mb-2">Address</label>
                                                <textarea class="form-control"
                                                          name="address" id="add2"
                                                          rows="2"
                                                          >{{$lab->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" {{($lab->status == "1") ? "checked" : ""}} required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" {{($lab->status == "0") ? "checked" : ""}} required>
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
                lab_name: "required",
                room_number: "required",
                status:"required",
            },
            messages:{
                lab_name:"Lab name is required",
                room_number: "Room number is required",
                status: "Status is required",
            }
        });

        $('#checkAll').click(function(e){
            var table= $(e.target).closest('table');
            $('td input:checkbox',table).prop('checked',this.checked);
        });

        $(".select2").select2({
            allowClear: true
        })





    </script>
@endpush

