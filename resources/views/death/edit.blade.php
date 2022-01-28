@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Death Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('death.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('death.update', $death->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="patient_id" class="mb-2 d-flex align-items-center">{{'Patient Name'}}</label>
                                                <select name="patient_id" class="form-select">
                                                    <option hidden value="{{old('patient_id', $death->patient_id)}}">
                                                        {{$death->patients->full_name}}</option>
                                                    @foreach($patients as $patient)
                                                        <option value="{{$patient->id}}" {{$patient->patient_id == $patient->id}}>{{$patient->full_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="mb-2 d-flex align-items-center">{{'Date'}}</label>
                                                <input type="date" value="{{ old('date',$death->date) }}" class="form-control" id="date" name="date">
                                            </div>
                                            <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="time" class="mb-2 d-flex align-items-center">{{'Time'}}</label>
                                                <input type="time" value="{{ old('time',$death->time) }}" class="form-control" id="time" name="time">
                                            </div>
                                            <span class="text-danger">@error('time'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">{{'Authorized Doctor Name'}}</label>
                                                <select name="doctor_id" class="form-select">
                                                    {{--                                                    <option hidden--}}
                                                    {{--                                                            value="{{ old('doctor_id', $bedList->doctor_id) }}"> {{ $bedList->bedTypes->name }}</option>--}}
                                                    {{--                                                    @foreach($bedTypes as $bedType)--}}
                                                    {{--                                                        <option value="{{ $bedType->id }}" {{$bedType->doctor_id == $bedType->id  ? 'selected' : ''}}>{{ $bedType->name }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('doctor_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2 d-flex align-items-center">{{"Receiver's Contact"}}</label>
                                                <input type="text" value="{{ old('phone_number',$death->phone_number) }}" class="form-control" id="phone_number" name="phone_number">
                                            </div>
                                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="note" class="form-label">{{'Note'}}</label>
                                                <textarea class="form-control" name="note" rows="3">{{ old('note', $death->note) }}</textarea>
                                            </div>
                                            <span class="text-danger">@error('note'){{ $message }}@enderror</span>
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
    // function formatState (state) {
    //     if (!state.id) {
    //         return state.text;
    //     }
    //
    //     var $state = $(
    //         '<span><img class="img-flag" /> <span></span></span>'
    //     );
    //
    //     // Use .text() instead of HTML string concatenation to avoid script injection issues
    //     $state.find("span").text(state.text);
    //     $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".png");
    //
    //     return $state;
    // }

    $('#checkAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });

    $(".select2").select2({
        allowClear: true
    })

    function onDelete(e) {
        console.log(e.value)
        document.getElementById('delForm').setAttribute('action', e.value)
    }



</script>
@endpush

