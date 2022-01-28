@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Bed List</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('bed-list.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editForm" class="form form-vertical" action="{{route('bed-list.update', $bedList->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="bed_number" class="mb-2">Bed Number</label>
                                                <input type="text" value="{{ucwords($bedList->bed_number)}}"  class="form-control" id="bed_number" name="bed_number">
                                            </div>
                                            <span class="text-danger">@error('bed_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="bed_type_id" class="mb-2 d-flex align-items-center">Bed Type</label>
                                                <select name="bed_type_id" class="form-select select2" style="width: 100%">
@foreach($bedTypes as $bedType)
                                                        <option value="{{ $bedType->id }}" {{$bedList->bed_type_id == $bedType->id  ? 'selected' : ''}}>{{ $bedType->title }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('bed_type_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="floor_no" class="mb-2 d-flex align-items-center">Floor No</label>
                                                <input type="text" value="{{$bedList->floor_no}}" class="form-control" id="floor_no" name="floor_no">
                                            </div>
                                            <span class="text-danger">@error('floor_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="mb-2 d-flex align-items-center">Price</label>
                                                <input type="number" min="0" value="{{ $bedList->price }}" class="form-control" id="price" name="price">
                                            </div>
                                            <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description" class="mb-2">Description</label>
                                                <textarea class="form-control" name="description" rows="3">{{$bedList->description}}</textarea>
                                            </div>
                                            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Availability</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" {{($bedList->status == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" {{($bedList->status == "0") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="availability"><span class="required">*</span> Availability</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="availability" id="available"
                                                           value="1" {{($bedList->availability == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="available">Available</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="availability" id="not_available"
                                                           value="0" {{($bedList->availability == "0") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="not_available">Not Available</label>
                                                </div>
                                                <span class="text-danger">@error('availability'){{ $message }}@enderror</span>
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
            bed_number: "required",
            bed_type_id:"required",
            floor_no:"required",
            price:"required",
            status: "required",

        },
        messages:{
            bed_number: "Bed Number is required",
            bed_type_id: "Bed Type is required",
            floor_no: "Floor is required",
            price: "Price is required",
            status: "Status is required",
        }
    });



    $(".select2").select2({
        allowClear: true
    })




</script>
@endpush

