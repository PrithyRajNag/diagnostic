@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Doctor Percentage</h3>
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
                            <form id="createForm" class="form form-vertical" action="{{route('doctor-percentage.store')}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($errors->any())
                                    <span class="text-danger font-italic">Message: {{ implode(', ', $errors->all(':message')) }}<br> please fill out indicated field(s)</span>
@endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center"><span class="required">*</span> Doctor</label>
                                                <select name="doctor_id" class="form-control select2" style="width: 100%" required>
                                                    <option hidden value="{{ old('doctor_id') }}"></option>
                                                    @foreach($doctors as $doctor)
                                                        <option
                                                            value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected': '' }}>{{ $doctor->full_name }}
                                                            ({{$doctor->departments->title}})</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="percentage" class="form-label"><span class="required">*</span> Percentage</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" min="0" name="percentage"
                                                           id="percentage">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <span class="text-danger">@error('percentage'){{ $message }}@enderror</span>
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
