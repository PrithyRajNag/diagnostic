@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Bed</h3>
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
                            <form id="createForm" class="form form-vertical" action="{{route('bed-list.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="bed_number" class="mb-2"><span class="required">*</span> Bed Number</label>
                                                <input type="text" class="form-control" id="bed_number" name="bed_number" value="{{ old('bed_number') }}"
                                                       placeholder="Bed Number" required>
                                            </div>
                                            <span class="text-danger">@error('bed_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                            <label for="bed_type_id" class="mb-2 d-flex align-items-center"><span class="required">*</span> Bed Type</label>
                                                <select name="bed_type_id" class="form-select select2" style="width: 100%" required>
                                                    <option hidden value=""></option>
                                                    @foreach($bedTypes as $bedType)
                                                        <option value="{{ $bedType->id }}">{{ $bedType->title }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('bed_type_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="floor_no" class="mb-2"><span class="required">*</span> Floor No</label>
                                                <input type="text" class="form-control" id="floor_no" name="floor_no" value="{{ old('floor_no') }}"
                                                       placeholder="Floor No" required>
                                            </div>
                                            <span class="text-danger">@error('floor_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="mb-2"><span class="required">*</span> Price</label>
                                                <input type="number" min="0" class="form-control" id="price" name="price" value="{{ old('price') }}"
                                                       placeholder="Price" required>
                                            </div>
                                            <span class="text-danger">@error('price'){{ $message }}@enderror</span>
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
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span>
                                                    Availability</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="availability"
                                                           id="available"
                                                           value="1" @if( old('availability')) == "1" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="available">Available</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="availability"
                                                           id="not_available"
                                                           value="0" @if( old('availability')) == "0" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="not_available" >Not Available</label>
                                                </div>
                                                <span class="text-danger">@error('availability'){{ $message }}@enderror</span>
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

    </script>
@endpush
