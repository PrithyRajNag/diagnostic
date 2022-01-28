@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Test Invoice</h3>
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
                            <form id="editForm" class="form form-vertical"
                                  action="{{route('test-invoice.update', $testInvoice->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                @if($errors->any())
                                    {{ implode('', $errors->all('<div>:message</div>')) }}

                                @endif
                                <div class="form-body">
                                    <input type="text" id="patient_id" name="patient_id"
                                           value="{{$testInvoice->patient_id}}" hidden>
                                    <div class="divider">
                                        <div class="divider-text">
                                            <h3>Patient Information</h3>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">PID</span>
                                                    <input type="text" class="form-control" id="pid" name="pid"
                                                           value="{{old('pid', $testInvoice->pid)}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Phone Number</span>
                                                    <input type="text" class="form-control" id="phone_no"
                                                           name="phone_no"
                                                           value="{{old('phone_no',$testInvoice->phone_no )}}"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="mb-2">First Name</label>
                                            <input type="text" class="form-control" id="first_name"
                                                   name="first_name"
                                                   value="{{ $testInvoice->first_name }}"
                                                   required readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="last_name" class="mb-2">Last Name</label>
                                            <input type="text" class="form-control" id="last_name"
                                                   name="last_name"
                                                   value="{{ $testInvoice->last_name }}"
                                                   required readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="age" class="mb-2">Age</label>
                                            <input type="number" min="0" class="form-control" id="age"
                                                   name="age"
                                                   value="{{ $patient->age }}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="mb-2"><span class="required">*</span>
                                                Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender" value="{{ ucfirst($patient->gender) }}" readonly>
                                        </div>
                                        <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number" class="mb-2"><span
                                                    class="required">*</span> Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number"
                                                   name="phone_number"
                                                   value="{{ $testInvoice->phone_number }}"
                                                   placeholder="+88" required readonly>
                                        </div>
                                        <span
                                            class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="invoice_date" class="mb-2"> Invoice Date</label>
                                            <input type="date" class="form-control" id="invoice_date"
                                                   name="invoice_date"
                                                   value="{{ $testInvoice->invoice_date }}"
                                             readonly>
                                        </div>
                                        <span
                                            class="text-danger">@error('invoice_date'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="delivery_date" class="mb-2"> Delivery Date</label>
                                            <input type="date" class="form-control" id="delivery_date"
                                                   name="delivery_date"
                                                   value="{{ old('delivery_date',$testInvoice->delivery_date) }}"
                                            >
                                        </div>
                                        <span
                                            class="text-danger">@error('delivery_date'){{ $message }}@enderror</span>
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
                                                @foreach($testItems->where('category_id', $category->id) as $item)
                                                    <div class="col-md-12">
                                                        <div class='form-check'>
                                                            <div class="custom-control custom-checkbox">

                                                                <input type="checkbox"
                                                                       class="select-test form-check-input form-check-secondary"
                                                                       data-value="{{$item->price}}"
                                                                       name="title[]"
                                                                       value="{{$item->test_name}}"
                                                                    {{Helper::checkedTitle($testInvoice->details, $item->test_name)}}
                                                                >
                                                            </div>
                                                            <input type="checkbox" class="price" name="price[]"
                                                                   value="{{$item->price}}"
                                                                   {{Helper::checkedTitle($testInvoice->details, $item->test_name)}}
                                                                   hidden>
                                                            <span id="check">{{ucwords($item->test_name)}} ( {{$item->price}} )</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-sm-6 col-md-6 ">
                                        <div class="row" id="selectedTest"></div>
                                        <div class="row mt-2">
                                            @if($testInvoice->doctor_percentage_id != null)
                                                <div class="col-sm-6 col-md-12">
                                                    <label for="doctor_percentage_id" class="mb-2">Referred Doctor</label>
                                                    <fieldset class="form-group">
                                                        <select name="doctor_percentage_id" id="doctorPercentageId" class="form-control select2" disabled>
                                                            <option hidden value="{{ old('doctor_percentage_id') }}"></option>
                                                            @foreach($doctor_percentages as $doctor_percentage)
                                                                <option
                                                                    value="{{ $doctor_percentage->id }}" {{ $testInvoice->doctor_percentage_id == $doctor_percentage->id ? 'selected': '' }}>{{ $doctor_percentage->doctors->full_name }}
                                                                    ({{$doctor_percentage->doctors->departments->title}}) - {{$doctor_percentage->percentage}}%</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                    <span class="text-danger">@error('doctor_percentage_id'){{ $message }}@enderror</span>
</div>
                                            @endif
                                            <div class="col-sm-6 col-md-12">
                                                <label for="total" class="form-label">Total :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0"
                                                           name="total"
                                                           id="total" readonly>
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            @if($testInvoice->vat != 0)
                                                <div class="col-sm-6 col-md-12">
                                                    <label for="vat" class="form-label">VAT :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="0"

                                                               value="{{$testInvoice->vat}}" readonly>
                                                        <span class="input-group-text">BDT</span>
                                                        <input type="text" id="vat" value="{{($testInvoice->vat *100) / $testInvoice->total ?? ''}}" readonly hidden >
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-sm-6 col-md-12">
                                                    <label for="vat" class="form-label">VAT :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control withoutDiscount" min="0" name="vat"
                                                               id="vat"
                                                               value="{{old('vat') ?? 0}}">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($testInvoice->discount != 0)
                                                <div class="col-sm-6 col-md-12">
                                                    <label for="discount" class="form-label">Discount :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number"
                                                               value="{{$testInvoice->discount}}"
                                                               class="form-control" min="0"
                                                               readonly>

                                                        <span class="input-group-text">BDT</span>
                                                        <input type="text" id="discount" value="{{($testInvoice->discount *100) / $testInvoice->total ?? ''}}" hidden>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-sm-6 col-md-12">
                                                    <label for="discount" class="form-label">Discount :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number"
                                                               value="{{ old('discount') ?? 0}}"
                                                               class="form-control withoutVat" min="0"
                                                               max="100" name="discount"
                                                               id="discount">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-sm-6 col-md-12">
                                                <label for="hospital_discount" class="form-label">Hospital
                                                    Discount :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="{{$payment->hospital_discount ?? ''}}"
                                                           class="form-control withoutVat withoutDiscount" min="0"
                                                           name="hospital_discount"
                                                           id="hospital-discount">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <label for="paid_amount" class="form-label">Paid Amount
                                                    :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="0" class="form-control withoutVat withoutDiscount" min="0"
                                                           name="paid-amount"
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
                                                        <label for="vat" class="form-label d-block p-2">VAT (+) :
                                                            <span id="vat-amount"></span></label>
                                                        <input type="text" name="vat_amount" id="calculated_vat" hidden>
                                                        <input type="text" id="previousVat"
                                                               value="{{$payment->vat ?? ''}}" hidden>

                                                        <label for="discount" class="form-label d-block p-2">Discount (-) :
                                                            <span id="discount-amount"></span></label>
                                                        <input type="text" name="discount_amount"
                                                               id="calculated_discount"
                                                               hidden>
                                                        <input type="text" id="previousDiscount"
                                                               value="{{$payment->discount ?? ''}}" hidden >
                                                        <label for="hospital_discount"
                                                               class="form-label d-block p-2">Hospital Discount (-) :
                                                            <span id="hospital-discount-amount"></span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="netTotal" class="form-label d-block p-2 ">Net Total
                                                            :
                                                            <span
                                                                style="font-family: 'Lucida Sans Typewriter'"
                                                                class="font-bold"
                                                                id="net-total">0.00</span> BDT</label>
                                                        <input type="number" class="form-control" min="0"
                                                               name="net_total"
                                                               id="netTotal" hidden>
                                                        <input type="number" class="form-control" min="0"
                                                               id="previousNetTotal" value="{{$payment->total ?? ''}}"
                                                               hidden>

                                                        <label for="paidAmount" class="form-label d-block p-2 ">Paid
                                                            Amount :
                                                            <span
                                                                style="font-family: 'Lucida Sans Typewriter'"
                                                                class="font-bold"
                                                                id="paidAmount">0.00</span> BDT</label>
                                                        <input type="number" class="form-control" min="0"
                                                               name="paid_amount" id="paid_amount"
                                                               hidden>
                                                        <input type="number" class="form-control" id="previouslyPaid"
                                                               value="{{$payment->paid_amount ?? ''}}"
                                                               hidden>

                                                        <label for="due" class="form-label d-block p-2 ">Due :
                                                            <span
                                                                style="font-family: 'Lucida Sans Typewriter'"
                                                                class="font-bold"
                                                                id="dueAmount">0.00</span> BDT</label>
                                                        <div class="input-group mb-3 text-right">
                                                            <input type="number" class="form-control" min="0"
                                                                   name="due"
                                                                   id="due" hidden>
                                                            <input type="number" class="form-control" id="previousDue"
                                                                   value="{{$payment->due ?? ''}}" hidden>
                                                        </div>
                                                    </div>
                                                </div>
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
        var chk1 = $(".select-test");
        chk1.on('change', function () {
            $(this).closest("div").next().prop('checked', $(this).is(":checked"));
        });


        let tests = [];
        let totalPrice = [];

        let previousNetTotal = Number($('#previousNetTotal').val());
        let previouslyPaid = Number($('#previouslyPaid').val());
        let previousDue = Number($('#previousDue').val());
        let previousVat = $('#previousVat').val();
        let previousDiscount = $('#previousDiscount').val();

        let vat = 0;
        let discount = 0;
        let netTotal = 0;
        let hospitalDiscount = 0;
        let due = 0;

        [].forEach.call(document.querySelectorAll('input[name="title[]"]:checked'), function (e) {

            let reducer = (previousValue, currentValue) => previousValue + currentValue;

            tests.push(e.value);
            totalPrice.push($(e).data('value'))
            $("#selectedTest").html(tests.map((test) => `<div class="col-xs-3 col-md-3 col-lg-3"><div class='badge bg-info mb-2 text-wrap ' style="width:100%; "> <span id='selectedTest'>${test.trim()}</span> </div></div>`).join(' '));
            $("#total").val(totalPrice.reduce(reducer, 0))
            $("#netTotal").val($("#previousNetTotal").val())
            $("#net-total").text($("#previousNetTotal").val())

            $("#paidAmount").text(previouslyPaid)
            $("#paid_amount").val(previouslyPaid)

            $("#dueAmount").text(previousDue)
            $("#due").val(previousDue)

            $("#vat-amount").text(previousVat)
            $("#calculated_vat").val(previousVat)

            $("#discount-amount").text(previousDiscount)
            $('#calculated_discount').val(previousDiscount)
        });


        $("input[type='checkbox']").change(function (e) {

            let testName = $(this).attr("value");

            if ($(this).is(':checked')) {
                tests.push(testName); //pushing checked tests in array
                //pushing checked tests in array
                totalPrice.push($(this).data('value'))
            } else {
                let index = tests.indexOf(e.target.value)
                tests.splice(index, 1)
                totalPrice.splice(index, 1) //remove unchecked from array
            }
            let reducer = (previousValue, currentValue) => previousValue + currentValue;
            $("#selectedTest").html(tests.map((test) => `<div class="col-xs-3 col-md-3 col-lg-3"><div class='badge bg-info mb-2 text-wrap ' style="width:100%; "> <span id='selectedTest'>${test.trim()}</span> </div></div>`).join(' '));
            //calculated test price in Total
            $("#total").val(totalPrice.reduce(reducer, 0)) //calculated test price in Total

            let total = Number($('#total').val());
            let vatAmount = Number($("#vat").val());
            vat = Math.ceil((total * vatAmount) / 100);
            let afterVat = total + vat

            let discountAmount = Number($("#discount").val());
            discount = Math.ceil((total * discountAmount) / 100)


            let hospitalDiscount = Number($("#hospital-discount").val());

            let paidAmount = Number($("#paid-amount").val());
            let totalPaid = Number(paidAmount + previouslyPaid)
            netTotal = Math.ceil(afterVat - (discount + hospitalDiscount))
            due = netTotal - totalPaid

            if (due <= 0) {
                $('#dueAmount').text(0)
                $('#due').val(0)
            } else {
                $('#dueAmount').text(due)
                $('#due').val(due)
            }

            $("#net-total").text(netTotal)
            $("#netTotal").val(netTotal)

            $("#vat-amount").text(vat)
            $("#calculated_vat").val(vat)

            $("#discount-amount").text(discount)
            $("#calculated_discount").val(discount)
        });

        $("input[type='number']").on('input', function (e) {
            let total = Number($('#total').val());

            //for vat
            let vatAmount = Number($("#vat").val());
            vat = Math.ceil((total * vatAmount) / 100);
            let afterVat = total + vat


            //for discount
            let discountAmount = Number($("#discount").val());
            console.log(discountAmount)
            discount = Math.ceil((total * discountAmount) / 100)

            //for hospital discount
            let hospitalDiscount = Number($("#hospital-discount").val());

            let paidAmount = Number($("#paid-amount").val());
            let totalPaid = Number(paidAmount + previouslyPaid)


            netTotal = Math.ceil(afterVat - (discount + hospitalDiscount))
            due = netTotal - totalPaid


            $('#netTotal').val(netTotal)
            $('#net-total').text(netTotal)

            $('#vat-amount').text(vat)
            $('#calculated_vat').val(vat)

            $('#discount-amount').text(discount)
            $('#calculated_discount').val(discount)

            $('#hospital-discount-amount').text(hospitalDiscount)

            $('#paidAmount').text(totalPaid)
            $('#paid_amount').val(totalPaid)
            if (due <= 0) {
                $('#dueAmount').text(0)
                $('#due').val(0)
            } else {
                $('#dueAmount').text(due)
                $('#due').val(due)
            }
        })

        //get patient by PID
        $(document).ready(function () {
            $('#paid-amount').val(0);
            $("#pid").keyup(function (e) {
                let pid = e.target.value;
                if (pid.length === 0) {
                    $('#first_name').val('')
                    $('#last_name').val('')
                    $('#age').val('')
                    $('#gender').val('')
                    $('#phone_number').val('')
                    $('#phone_no').val('')
                    $('#patient_id').val('')
                }
                fetch(`/test-invoice/get-patient/${pid}`)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        $('#first_name').val(res.first_name)
                        $('#last_name').val(res.last_name)
                        $('#age').val(res.age)
                        $('#gender').val(res.gender)
                        $('#phone_number').val(res.phone_no)
                        $('#phone_no').val(res.phone_no)
                        $('#patient_id').val(res.id)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            })


            $("#phone_no").keyup(function (f) {
                let number = f.target.value;
                if (number.length === 0) {
                    $('#first_name').val('')
                    $('#last_name').val('')
                    $('#age').val('')
                    $('#gender').val('')
                    $('#phone_number').val('')
                    $('#patient_id').val('')
                    $('#pid').val('')
                }
                fetch(`/test-invoice/get-patient-by-number/${number}`)
                    .then(res => res.json())
                    .then(res => {
                        $('#first_name').val(res.first_name)
                        $('#last_name').val(res.last_name)
                        $('#age').val(res.age)
                        $('#gender').val(res.gender)
                        $('#phone_number').val(res.phone_no)
                        $('#patient_id').val(res.id)
                        $('#pid').val(res.pid)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            })
        })

        $("#editForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                date: "required",
                account_id: "required",
                pay_to: "required",
                amount: "required",
                status: "required",
            },
            messages: {
                date: "Date field is required",
                account_id: "Account Name field is required",
                pay_to: "Pay to field is required",
                amount: "Amount field id required",
                status: "Status field is required",
            }
        });

        $('#checkAll').click(function (e) {
            var table = $(e.target).closest('table');
            $('td input:checkbox', table).prop('checked', this.checked);
        });

        $(".select2").select2({
            allowClear: true
        })

    </script>
@endpush

