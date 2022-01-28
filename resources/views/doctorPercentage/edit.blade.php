@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Doctor Percentage Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('doctor-percentage.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editForm" class="form form-vertical"
                                  action="{{route('doctor-percentage.update', $doctorPercentage->uuid)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2"><span class="required">*</span> Doctor</label>
                                                <select name="doctor_id" class="form-control select2" required>
                                                    <option hidden value=""></option>
                                                    @foreach($doctors as $doctor)
                                                        <option
                                                            value="{{ $doctor->id }}" {{$doctorPercentage->doctors->id == $doctor->id ? 'selected' : ''}}>{{ucwords($doctor->full_name)}} ({{$doctor->departments->title}})</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="percentage" class="form-label"><span class="required">*</span> Percentage</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" min="0" name="percentage" value="{{$doctorPercentage->percentage}}"
                                                           id="percentage">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <span class="text-danger">@error('percentage'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="1" {{($doctorPercentage->status == "1") ? "checked" : ""}}>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="0" {{($doctorPercentage->status == "0") ? "checked" : ""}}>
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
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
    </div>
@endsection
@push('customScripts')

    <script>



        $('#editForm').validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                doctor_id: "required",
                percentage: "required",

            },
            messages: {
                doctor_id: "Doctor Name is required",
                percentage: "Percentage is required",
            }
        });

        $(".select2").select2({
            allowClear: true
        })


    </script>
@endpush

