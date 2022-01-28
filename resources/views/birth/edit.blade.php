@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Birth Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('birth.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('birth.update',1)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="mb-2">{{'Name'}}</label>
                                                <input type="text" value=""  class="form-control" id="name" name="name">
                                            </div>
                                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="weight" class="mb-2">{{'Weight'}}</label>
                                                <input type="text" value=""  class="form-control" id="weight" name="weight">
                                            </div>
                                            <span class="text-danger">@error('weight'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="gender" class="mb-2 ">{{'Gender'}}</label>
                                                <select name="gender" class="form-select">
{{--                                                    <option hidden value="{{ $birth->gender ?? old('gender') ?? ''}}">{{ucwords($birth->gender)}}</option>--}}
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="blood_group" class="mb-2">{{'Blood Group'}}</label>
                                                <select name="blood_group" class="form-select" required>
                                                    <option hidden
{{--                                                            value="{{ $birth->blood_group ?? old('blood_group') ?? '' }}"> {{ucwords($birth->blood_group ?? '')}}</option>--}}
                                                    <option value="a+">A+</option>
                                                    <option value="a-">A-</option>
                                                    <option value="b+">B+</option>
                                                    <option value="b-">B-</option>
                                                    <option value="o+">O+</option>
                                                    <option value="o-">O-</option>
                                                    <option value="ab+">AB+</option>
                                                    <option value="ab-">AB-</option>
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('blood_group'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="doctor_id" class="mb-2 d-flex align-items-center">{{'Doctor Name'}}</label>
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
                                                <label for="mother_name" class="mb-2">{{'Mother Name'}}</label>
                                                <input type="text" value=""  class="form-control" id="mother_name" name="mother_name">
                                            </div>
                                            <span class="text-danger">@error('mother_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="father_name" class="mb-2">{{'Father Name'}}</label>
                                                <input type="text" value=""  class="form-control" id="father_name" name="father_name">
                                            </div>
                                            <span class="text-danger">@error('father_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2 d-flex align-items-center">{{'Phone NUmber'}}</label>
                                                <input type="text" value="" class="form-control" id="phone_number" name="phone_number">
                                            </div>
                                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="mb-2 d-flex align-items-center">{{'Date'}}</label>
                                                <input type="date" value="" class="form-control" id="date" name="date">
                                            </div>
                                            <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="time" class="mb-2 d-flex align-items-center">{{'Time'}}</label>
                                                <input type="time" value="" class="form-control" id="time" name="time">
                                            </div>
                                            <span class="text-danger">@error('time'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="note" class="form-label">{{'Note'}}</label>
                                                <textarea class="form-control" name="note" rows="3"></textarea>
                                            </div>
                                            <span class="text-danger">@error('note'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col- mt-2">
                                            <label for="address" class="mt-2 font-weight-bolder">Address</label>
                                            <hr style="margin: 10px 0px">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address['country']"
                                                       class="mb-2">Country</label>
                                                <input type="text" name="address[country]"
                                                       id="country" class="form-control"
                                                       value=" ">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[district]"
                                                       class="mb-2">District</label>
                                                <input type="text" name="address[district]" id="district"
                                                       class="form-control"
                                                       value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[upazila]" class="mb-2">Thana/Upazila</label>
                                                <input type="text" name="address[upazila]" id="upazila"
                                                       class="form-control"
                                                       value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[post_code]" class="mb-2">Post Code</label>
                                                <input type="text" name="address[post_code]" id="post"
                                                       class="form-control"
                                                       value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line1]" class="mb-2">Address Line 1</label>
                                                <textarea class="form-control"
                                                          name="address[address_line1]" id="add1"
                                                          rows="2"
                                                          required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="address[address_line2]" class="mb-2">Address Line 2</label>
                                                <textarea class="form-control"
                                                          name="address[address_line2]" id="add2"
                                                          rows="2"
                                                          required></textarea>
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

