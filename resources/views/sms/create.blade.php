@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create SMS</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('sms.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('sms.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 mb-3 d-flex">
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="admin" type="radio" name="sms_to" value="admin" @if( old('sms_to')) == "admin" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="admin">Admins</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="doctor" type="radio" name="sms_to" value="doctor" @if( old('sms_to')) == "doctor" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="doctor">Doctors</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="nurse" type="radio" name="sms_to" value="nurse" @if( old('sms_to')) == "nurse" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="nurse">Nurses</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="accountant" type="radio" name="sms_to" value="accountant" @if( old('sms_to')) == "accountant" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="accountant">Accountants</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="laboratorist"  type="radio" name="sms_to" value="laboratorist" @if( old('sms_to')) == "laboratorist" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="laboratorist">Laboratorists</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="pharmacist"  type="radio" name="sms_to" value="pharmacist" @if( old('sms_to')) == "pharmacist" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="pharmacist">Pharmacists</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="all" type="radio" name="sms_to" value="all" @if( old('sms_to')) == "all" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="all">All Users</label>
                                            </div>
                                            <div style="padding-right: 15px">
                                                <input class="form-check-input" id="specific" type="radio" name="sms_to" value="specific" @if( old('sms_to')) == "specific" ? 'checked' : '' @endif>
                                                <label class="form-check-label" for="specific">Specific</label>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('sms_to'){{ $message }}@enderror</span>
                                        <div class="col-sm-12 col-md-6" id="receiver">
                                            <div class="form-group">
                                                <label for="receiver" class="form-label"><span class="required">*</span>  Receiver Number</label>
                                                <input type="text" class="form-control" name="receiver" id="phone_number"
                                                       placeholder="Receiver Number" value="{{ old('receiver') }}">
                                            </div>
                                            <span class="text-danger">@error('receiver'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="subject"
                                                       class="form-label"><span class="required">*</span> Subject</label>
                                                <textarea class="form-control" name="subject" rows="1">{{ old('subject') }}</textarea>
                                                <span class="text-danger">@error('subject'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="message"
                                                       class="form-label"><span class="required">*</span> Message</label>
                                                <textarea class="form-control" name="message" rows="3">{{ old('message') }}</textarea>
                                                <span class="text-danger">@error('message'){{ $message }}@enderror</span>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
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
            sms_to: "required",
            subject : "required",
            message : "required",
            receiver: {
                maxlength:11
            },
        },
        messages:{
            sms_to: "Receiver is required",
            subject: "Subject is required",
            message: "Message is required",
            receiver: {
                maxlength: "Phone Number is greater than 11 digits"
            },
        }
    });


    $(".select2").select2({
        allowClear: true
    })

    function onDelete(e) {
        console.log(e.value)
        document.getElementById('delForm').setAttribute('action', e.value)
    }
    $("#receiver").hide();
    $('input[name="sms_to"]').on('change', function () {
        if (this.value != 'specific') {
            $("#receiver").hide()
        } else {
            $("#receiver").show()
            $("#phone_number").attr('required', '');
        }
    });

</script>
@endpush
