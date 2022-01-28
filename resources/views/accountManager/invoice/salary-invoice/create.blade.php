@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Salary Invoice</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('salary-invoice.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('salary-invoice.store')}}"
                                  method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="mb-2 p-2">
                                        <input type="text" id="profile_id" name="profile_id" hidden>
                                        <div class="divider">
                                            <div class="divider-text">
                                                <h3 class="text-capitalize">Employee Information</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 form-group">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Phone Number</span>
                                                    <input type="text" class="form-control" id="phone_number"
                                                           name="phone_number" value="{{old('phone_number')}}"
                                                           placeholder="Insert Mobile Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="mb-2"> First Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                           name="first_name" placeholder="First Name"
                                                           style="cursor: not-allowed" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="mb-2"> Last Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                           name="last_name" placeholder="Last Name"
                                                           style="cursor: not-allowed" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="gender" class="mb-2"> Gender</label>
                                                    <input type="text" class="form-control" id="gender"
                                                           name="gender" placeholder="Gender" readonly>
                                                </div>
                                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6 form-group">
                                                <label for="salary" class="form-label">Salary :</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control"  name="salary"
                                                           id="salary" readonly>
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-2" >
                                        <div class="col-sm-6 col-md-6" style="border-right: green solid 2px;">
                                            <div class="col-sm-6 col-md-12 form-group">
                                                <label for="overTime" class="form-label">Over Time :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="overtime"
                                                           id="overTime" value="0">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 form-group">
                                                <label for="bonus" class="form-label">Bonus :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="bonus"
                                                           id="bonus" value="0">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 form-group">
                                                <label for="tax" class="form-label">Tax :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="tax"
                                                           id="tax" value="0">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 form-group">
                                                <label for="paid_amount" class="form-label"><span class="required">*</span> Paid Amount :</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="paid_amount"
                                                           id="paid_amount" >
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 form-group">
                                                <div class='form-check'>
                                                    <div class="custom-control custom-checkbox">
                                                        <label for="full_paid" class="form-label" style="font-family: Cuprum; ">Full Paid</label>
                                                        <input type="checkbox" id="full_paid"
                                                               class="select-test form-check-input form-check-secondary"
                                                               value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="divider">
                                                <div class="divider-text">Payable Amount</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="calculated_tax" class="form-label d-block p-2">Tax (-) : <span
                                                            id="tax-amount"></span></label>
                                                    <input type="text" name="tax" id="calculated_tax" hidden>

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="netSalary" class="form-label d-block p-2 ">Net Salary : <span
                                                            style="font-family: 'Lucida Sans Typewriter'" class="font-bold"
                                                            id="net-salary">0.00</span> BDT</label>
                                                    <input type="number" class="form-control" min="0" name="net_salary"
                                                           id="netSalary" hidden>

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
        // JQuery Validation
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                phone_number: "required",
                paid_amount : "required",
            },
            messages: {
                phone_number: "Phone Number is required",
                paid_amount: "Paid Amount is required",

            }
        });

        $(document).ready(function () {

            let bonus = 0;
            let tax = 0;
            let netSalary = 0;
            let due = 0;

            $("input[type='number']").on('input', function (e) {
                let total = Number($('#salary').val());
                bonus = Number($('#bonus').val());
                let overTime = Number($('#overTime').val());

                //for tax
                let taxAmount = Number($("#tax").val());
                tax =  Math.ceil((total * taxAmount) / 100);
                let netTotal = total + bonus + overTime

                let paidAmount = Number($("#paid_amount").val());

                netSalary = Math.ceil(netTotal - tax)
                due = Number(netSalary - paidAmount)

                $('#netSalary').val(netSalary)
                $('#net-salary').text(netSalary)
                $('#tax-amount').text(tax)
                $('#calculated_tax').val(tax)

                $('#dueAmount').text(due)
                $('#due').val(due)
            })

            $("input[type='checkbox']").change(function (e) {
                let total = Number($('#salary').val());

                bonus = Number($('#bonus').val());
                let overTime = Number($('#overTime').val());

                //for tax
                let taxAmount = Number($("#tax").val());
                tax =  Math.ceil((total * taxAmount) / 100);
                let netTotal = total + bonus + overTime


                netSalary = Math.ceil(netTotal - tax)
                let paidAmount = Number(netSalary);
                console.log(paidAmount)
                due = Number(netSalary - paidAmount)
                if ($(this).is(':checked')) {
                    $("#paid_amount").attr('readonly', true)
                    $('#bonus').attr('readonly', true)
                    $('#tax').attr('readonly', true)
                    $('#overTime').attr('readonly', true)
                    $("#paid_amount").val(paidAmount)
                }else {
                    $("#paid_amount").attr('readonly', false)
                    $("#bonus").attr('readonly', false)
                    $("#tax").attr('readonly', false)
                    $("#overTime").attr('readonly', false)
                    $("#paid_amount").val(0)
                }

                $('#netSalary').val(netSalary)
                $('#dueAmount').text(due)
                $('#due').val(due)

            })

            $("#phone_number").on('keyup',function (e) {
                $('#calculated_tax').val(0);
                let number = e.target.value;
                if(number.length === 0){
                    $('#first_name').val('')
                    $('#last_name').val('')
                    $('#gender').val('')
                    $('#profile_id').val('')
                    $('#salary').val('')
                }
                fetch(`/salary-invoice/get-staff-by-number/${number}`)
                    .then(res => res.json())
                    .then(res => {
                        $('#first_name').val(res.first_name)
                        $('#last_name').val(res.last_name)
                        $('#gender').val(res.gender)
                        $('#salary').val(res.salary)
                        $('#profile_id').val(res.id)
                        $('#net-salary').text(res.salary)
                        $('#dueAmount').text(res.salary)
                    })
                    .catch(err => {
                        console.log(err)
                    })

            })
        })

    </script>
@endpush
