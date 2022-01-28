@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Assigned Bed Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('bed-assign.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('bed-assign.update', $bedAssign->uuid)}}" method="POST" id="editForm">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="patient_id" class="mb-2 d-flex align-items-center">Patient</label>
                                            <div class="form-group">
                                                <select name="patient_id" class="form-select select2" style="width: 100%">
@foreach($patients as $patient)
                                                        <option value="{{ $patient->id }}" {{$bedAssign->patients[0]->id == $patient->id   ? 'selected' : ''}}>{{ $patient->full_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="bed_list_id" class="mb-2 d-flex align-items-center">Bed Number</label>
                                            <div class="form-group">
                                                <select name="bed_list_id" class="form-select select2" style="width: 100%">
                                                    <option hidden value="{{old('bed_list_id', $bedAssign->id)}}">{{$bedAssign->bed_number}}</option>
                                                    @foreach($bedLists as $bedList)
                                                        <option value="{{ $bedList->id }}" {{$bedAssign->id == $bedList->id ? 'selected' : ''}}>{{ $bedList->bed_number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('bed_list_id'){{ $message }}@enderror</span>
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

    $(".select2").select2({
        allowClear: true
    })

    function onDelete(e) {
        console.log(e.value)
        document.getElementById('delForm').setAttribute('action', e.value)
    }
    $("#editForm").validate({
        errorPlacement: function (error, e) {
            e.parents('.form-group').append(error);
        },
        rules:{
            bed_list_id: "required",
            patient_id:"required",
        },
        messages:{
            bed_list_id: "Bed Number is required",
            patient_id: "Patient is required",
        }
    });


</script>
@endpush

