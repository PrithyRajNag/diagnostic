@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Test Invoice</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('test-invoice.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('test-invoice.store')}}"
                                  method="POST">
                                @csrf
                                <div class="form-body">
                                    <input type="text" id="patient_id" name="patient_id" hidden>
                                    <div class="divider">
                                        <div class="divider-text">
                                            <h3>Patient Information</h3>
                                        </div>
                                    </div>
                                    <div class="mb-2 p-2">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">PID</span>
                                                    <input type="text" class="form-control" id="pid" name="pid"
                                                           value="{{old('pid')}}" placeholder="Insert PID">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Phone Number</span>
                                                    <input type="text" class="form-control" id="phone_no"
                                                           name="phone_no" value="{{old('phone_no')}}"
                                                           placeholder="Insert Mobile Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="mb-2"><span class="required">*</span> First Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                           name="first_name" placeholder="First Name" required>
                                                </div>
                                                <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="mb-2"><span class="required">*</span> Last Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                           name="last_name" placeholder="Last Name" required>
                                                </div>
                                                <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="age" class="mb-2"><span class="required">*</span> Age</label>
                                                    <input type="number" class="form-control" id="age" name="age"
                                                           value="" required>
                                                </div>
                                                <span class="text-danger">@error('age'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="gender" class="mb-2 d-flex align-items-center">Gender</label>
                                                    <select name="gender" id="gender"
                                                            class="form-control selector select2" style="width: 100%">
                                                        <option hidden value="" ></option>
                                                        <option value="male"
                                                                @if (old('gender') == 'male') selected="selected" @endif >
                                                            Male
                                                        </option>
                                                        <option value="female"
                                                                @if (old('gender') == 'female') selected="selected" @endif>
                                                            Female
                                                        </option>
                                                        <option value="other"
                                                                @if (old('gender') == 'other') selected="selected" @endif>
                                                            Other
                                                        </option>
                                                    </select>
                                                </div>
                                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number" class="mb-2"><span
                                                            class="required">*</span> Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_number"
                                                           name="phone_number" value="{{ old('phone_number') }}"
                                                           placeholder="+88" required>
                                                </div>
                                                <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="invoice_date" class="mb-2"> Invoice Date</label>
                                                    <input type="date" class="form-control" id="invoice_date"
                                                           name="invoice_date" value="{{ old('invoice_date') }}"
                                                           >
                                                </div>
                                                <span
                                                    class="text-danger">@error('invoice_date'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="delivery_date" class="mb-2"> Delivery Date</label>
                                                    <input type="date" class="form-control" id="delivery_date"
                                                           name="delivery_date" value="{{ old('delivery_date') }}"
                                                           >
                                                </div>
                                                <span
                                                    class="text-danger">@error('delivery_date'){{ $message }}@enderror</span>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-6" style="border-right: green solid 2px;">
                                        @foreach($categories as $category)
                                            <br>
                                            <div class="badge bg-warning">
                                                <span>{{$category->title}}</span>
                                            </div>
                                            <div class="col-md-12 p-3">
                                                <div class="row">
                                                    @foreach($testItems->where('category_id', $category->id) as $item)
                                                        <div class="col-md-6">
                                                            <div class='form-check'>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="select-test form-check-input form-check-secondary"
                                                                           data-value="{{$item->price}}" name="title[]"
                                                                           value="{{$item->test_name}}">
                                                                </div>
                                                                <input type="checkbox" class="price" name="price[]"
                                                                       value="{{$item->price}}" hidden>
                                                                <span>{{ucwords($item->test_name)}} ( {{$item->price}} )</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-sm-6 col-md-6 ">
                                        <div class="row" id="selectedTest"></div>
                                        <div class="row mt-2">
                                            <div class="col-sm-6 col-md-12">
                                                <label for="doctor_percentage_id" class="mb-2 d-flex align-items-center">Referred Doctor</label>
                                                <fieldset class="form-group">
                                                    <select name="doctor_percentage_id" id="doctorPercentageId" class="form-control select2" style="width: 100%" disabled>
                                                        <option hidden value="{{ old('doctor_percentage_id') }}"></option>
                                                        @foreach($doctor_percentages as $doctor_percentage)
                                                            <option
                                                                value="{{ $doctor_percentage->id }}" {{ old('doctor_percentage_id') == $doctor_percentage->id ? 'selected': '' }}>{{ $doctor_percentage->doctors->full_name }}
                                                                ({{$doctor_percentage->doctors->departments->title}}) - {{$doctor_percentage->percentage}}%</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                <span class="text-danger">@error('doctor_percentage_id'){{ $message }}@enderror</span>
                                                <input type="text" id="calculatedPercentage" value="0" hidden>
                                                <input type="text" name="doctor_percentage_amount" id="percentageAmount" value="0" hidden>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <label for="total" class="form-label">Total :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="total"
                                                           id="total" readonly>
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <label for="vat" class="form-label">VAT :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="vat"
                                                           id="vat" value="0">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-12">
                                                <label for="discount" class="form-label">Discount :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="0" class="form-control" min="0" max="100" name="discount"
                                                           id="discount">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <label for="hospital_discount" class="form-label">Hospital Discount :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="0" class="form-control" min="0" name="hospital_discount"
                                                           id="hospital-discount">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <label for="paid_amount" class="form-label">Paid Amount :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="0" class="form-control" min="0" name="paid_amount"
                                                           id="paid-amount">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-12">
                                                <div class="divider">
                                                    <div class="divider-text">Payable Amount</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="vat" class="form-label d-block p-2">VAT (+) : <span
                                                                id="vat-amount">0</span> BDT</label>
                                                        <input type="text" name="vat_amount" id="calculated_vat" hidden>
                                                        <label for="discount" class="form-label d-block p-2">Discount (-) :
                                                            <span id="discount-amount">0</span> BDT</label>
                                                        <input type="text" name="discount_amount" id="calculated_discount"
                                                               hidden>
                                                        <label for="hospital_discount" class="form-label d-block p-2">Hospital Discount (-) :
                                                            <span id="hospital-discount-amount" >0</span> BDT</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="netTotal" class="form-label d-block p-2 ">Net Total : <span
                                                                style="font-family: 'Lucida Sans Typewriter'" class="font-bold"
                                                                id="net-total">0.00</span> BDT</label>
                                                        <input type="number" class="form-control" min="0" name="net_total"
                                                               id="netTotal" hidden>

                                                        <label for="paidAmount" class="form-label d-block p-2 ">Paid Amount : <span
                                                                style="font-family: 'Lucida Sans Typewriter'" class="font-bold"
                                                                id="paidAmount">0.00</span> BDT
                                                        </label>

                                                        <label for="due" class="form-label d-block p-2 ">Due : <span
                                                                style="font-family: 'Lucida Sans Typewriter'" class="font-bold"
                                                                id="dueAmount">0.00</span> BDT</label>
                                                        <div class="input-group mb-3 text-right">
                                                            <input type="number" class="form-control" min="0" name="due"
                                                                   id="due" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end ">
                                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
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
        $("#doctorPercentageId").select2({
            placeholder : '--(If any) | Please Select Test(s) First   --',
            allowClear: true
        })

        // JQuery Validation
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                first_name:"required",
                last_name:"required",
                age:"required",
                phone_number: "required",
            },
            messages: {
                first_name: "First Name is required",
                last_name: "Last Name is required",
                age: "Age is required",
                phone_number: "Phone Number is required",
            }
        });
        //check one checked another
        var chk1 = $(".select-test");
        chk1.on('change', function () {
            $(this).closest("div").next().prop('checked', $(this).is(":checked"));
            console.log($(this).closest("div"))
        });



        //Appending Checked Tests Item on right
        let tests = [];
        let totalPrice = [];


        $("input[type='checkbox']").change(function (e) {
            var testName = $(this).attr("value");

            if ($(this).is(':checked')) {
                tests.push(testName); //pushing checked tests in array
                totalPrice.push($(this).data('value'))
            } else {
                let index = tests.indexOf(e.target.value)
                tests.splice(index, 1)
                totalPrice.splice(index, 1) //remove unchecked from array
            }
            if (tests.length !== 0){
                $('#doctorPercentageId').attr('disabled', false)
            }else {
                $('#doctorPercentageId').attr('disabled', true)
            }

            let reducer = (previousValue, currentValue) => previousValue + currentValue;
            $("#selectedTest").html(tests.map((test) => `<div class="col-xs-3 col-md-3 col-lg-3"><div class='badge bg-info mb-2 text-wrap ' style="width:100%; "> <span id='selectedTest'>${test.trim()}</span> </div></div>`).join(' '));
            $("#total").val(totalPrice.reduce(reducer, 0)) //calculated test price in Total

            $("#netTotal").val($("#total").val()) //calculated test price in net total
            $("#net-total").text($("#total").val()) //show calculated test price in Total

            $("#dueAmount").text($("#total").val())
            $("#due").val($("#total").val())
        });

        let vat = 0;
        let discount = 0;
        let netTotal = 0;
        let hospitalDiscount = 0;
        let due = 0;
        let doctorPercentage;

        //Percentage of selected doctor
        $("#doctorPercentageId").on('change', function (e) {
            let doctor_percentage_id = e.target.value;
            fetch(`/doctor-percentage/get-doctor-percentage/${doctor_percentage_id}`)
                .then(res => res.json())
                .then(res => {

                    doctorPercentage = res.percentage
                    console.log(doctorPercentage)
                    let total = Number($('#total').val());
                    let calculatedPercentage = Math.ceil((total * doctorPercentage) / 100)
                    $('#calculatedPercentage').val(calculatedPercentage)
                })
                .catch(err => {
                    console.log(err)
                })
        })

        $("input[type='number']").on('input', function (e) {
            let total = Number($('#total').val());

            //for vat
            let vatAmount = Number($("#vat").val());
            vat =  Math.ceil((total * vatAmount) / 100);
            let afterVat = total + vat

            //for discount
            let discountAmount = Number($("#discount").val());
            discount = Math.ceil((total * discountAmount) / 100)

            //for hospital discount
            let hospitalDiscount = Number($("#hospital-discount").val());
            let paidAmount = Number($("#paid-amount").val());

            netTotal = Math.ceil(afterVat - (discount+hospitalDiscount))
            due = netTotal - paidAmount

            //amount which will be received by doctor
            let doctorPercentageAmount = Number($('#calculatedPercentage').val() - discount)
            $('#percentageAmount').val(doctorPercentageAmount)


            $('#netTotal').val(netTotal)
            $('#net-total').text(netTotal)

            $('#vat-amount').text(vat)
            $('#calculated_vat').val(vat)

            $('#discount-amount').text(discount)
            $('#calculated_discount').val(discount)

            $('#hospital-discount-amount').text(hospitalDiscount)

            $('#paidAmount').text(paidAmount)
            $('#dueAmount').text(due)
            $('#due').val(due)
        })

        //get patient by PID
        $(document).ready(function () {

            $('#calculated_vat').val(0);
            $('#calculated_discount').val(0);
            $("#pid").keyup(function (e) {
                let pid = e.target.value;
                if(pid.length === 0){
                    $('#first_name').val('').attr('readonly',false)
                    $('#last_name').val('').attr('readonly',false)
                    $('#age').val('').attr('readonly',false)
                    $('#phone_number').val('').attr('readonly',false)
                    $('#phone_no').val('').attr('readonly',false)
                    $('#patient_id').val('')
                    const option = new Option('', '', false, true)
                    $('.selector').append(option).trigger('change').attr('disabled',false);
                }
                fetch(`/test-invoice/get-patient/${pid}`)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        $('#first_name').val(res.first_name).attr('readonly','readonly')
                        $('#last_name').val(res.last_name).attr('readonly','readonly')
                        $('#age').val(res.age).attr('readonly','readonly')
                        $('#phone_number').val(res.phone_no).attr('readonly','readonly')
                        $('#phone_no').val(res.phone_no).attr('readonly','readonly')
                        $('#patient_id').val(res.id).attr('readonly','readonly')
                        for (let i = 0; i < 3; i++) {
                            $(`.selector option[value=${res.gender}]`).remove()
                        }
                        const option = new Option(res.gender.toUpperCase(), res.gender, true, true)
                        $('.selector').append(option).trigger('change').attr("disabled",true);
                    })
                    .catch(err => {
                        console.log(err)
                    })
            })


            $("#phone_no").keyup(function (f) {
                let number = f.target.value;
                if(number.length === 0){
                    $('#first_name').val('').attr('readonly',false)
                    $('#last_name').val('').attr('readonly',false)
                    $('#age').val('').attr('readonly',false)
                    $('#phone_number').val('').attr('readonly',false)
                    $('#patient_id').val('').attr('readonly',false)
                    $('#pid').val('').attr('readonly',false)
                    const option = new Option('', '', false, true)
                    $('.selector').append(option).trigger('change').attr("disabled",false);
                }
                fetch(`/test-invoice/get-patient-by-number/${number}`)
                    .then(res => res.json())
                    .then(res => {
                        $('#first_name').val(res.first_name).attr('readonly','readonly')
                        $('#last_name').val(res.last_name).attr('readonly','readonly')
                        $('#age').val(res.age).attr('readonly','readonly')
                        $('#phone_number').val(res.phone_no).attr('readonly','readonly')
                        $('#patient_id').val(res.id).attr('readonly','readonly')
                        $('#pid').val(res.pid).attr('readonly','readonly')
                        for (let i = 0; i < 3; i++) {
                            $(`.selector option[value=${res.gender}]`).remove()
                        }
                        const option = new Option(res.gender.toUpperCase(), res.gender, true, true)
                        $('.selector').append(option).trigger('change').attr("disabled",true);

                    })
                    .catch(err => {
                        console.log(err)
                    })
            })

        })
    </script>
@endpush
