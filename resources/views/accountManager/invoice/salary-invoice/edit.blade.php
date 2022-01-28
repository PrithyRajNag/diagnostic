@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Salary Invoice</h3>
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
                            <form id="editForm" class="form form-vertical"
                                  action="{{route('salary-invoice.update', $salaryInvoice->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="mb-2 p-2">
                                        <input type="text" id="profile_id" name="profile_id" value="{{$salaryInvoice->profile_id}}" hidden>
                                        <div class="divider">
                                            <div class="divider-text">
                                                <h3 class="text-capitalize">Employee Information</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Phone Number</span>
                                                    <input type="text" class="form-control" id="phone_number"
                                                           name="phone_number" value="{{old('phone_number', $salaryInvoice->profiles->phone_number)}}"  style="cursor: not-allowed" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="mb-2"><span class="required">*</span> First Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                           name="first_name" value="{{$salaryInvoice->profiles->first_name}}"
                                                           style="cursor: not-allowed" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="mb-2"><span class="required">*</span> Last Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                           name="last_name" value="{{$salaryInvoice->profiles->last_name}}"
                                                           style="cursor: not-allowed" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="gender" class="mb-2"><span class="required">*</span> Gender</label>
                                                    <input type="text" class="form-control" id="gender"
                                                           name="gender" value="{{$salaryInvoice->profiles->gender}}"  style="cursor: not-allowed" readonly>
                                                </div>
                                                <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="salary" class="form-label">Salary :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"  name="salary"
                                                               id="salary" value="{{$salaryInvoice->profiles->salary}}"  style="cursor: not-allowed" readonly>
                                                        <span class="input-group-text">BDT</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-2" >
                                        <div class="col-sm-6 col-md-6" style="border-right: green solid 2px;">
                                            <div class="col-sm-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="overTime" class="form-label">Overtime :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="0" name="overtime"
                                                               id="overTime" value="{{$salaryInvoice->overtime}}">
                                                        <span class="input-group-text">BDT</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="bonus" class="form-label">Bonus :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="0" name="bonus"
                                                               id="bonus" value="{{$salaryInvoice->bonus}}">
                                                        <span class="input-group-text">BDT</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="tax" class="form-label">Tax :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="0" name="tax"
                                                               id="tax" value="{{round($salaryInvoice->tax * 100) / ($salaryInvoice->profiles->salary) }}">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="paid_amount" class="form-label">Paid Amount :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="0"
                                                               id="paid_amount" name="current_paid_amount">
                                                        <span class="input-group-text">BDT</span>
                                                    </div>
                                                    <input type="text"  id="previouslyPaid" value="{{$payment->paid_amount}}" hidden>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="divider">
                                                <div class="divider-text">Payable Amount</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="calculated_tax" class="form-label d-block p-2">Tax (-) :<span
                                                            id="tax-amount"></span> BDT </label>
                                                    <input type="text" name="tax" id="calculated_tax" hidden>
                                                    <input type="text" id="previous_tax" value="{{$salaryInvoice->tax}}" hidden >
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="netSalary" class="form-label d-block p-2 ">Net Salary : <span
                                                            style="font-family: 'Lucida Sans Typewriter'" class="font-bold"
                                                            id="net-salary">0.00</span> BDT</label>
                                                    <input type="number" class="form-control" min="0" name="net_salary"
                                                           id="netSalary" hidden>
                                                    <input type="number" class="form-control" min="0"
                                                           id="net-Salary" value="{{$salaryInvoice->net_salary}}" hidden >

                                                    <label for="paidAmount" class="form-label d-block p-2 ">Paid Amount : <span
                                                            style="font-family: 'Lucida Sans Typewriter'"
                                                            class="font-bold"
                                                            id="paidAmount">0.00</span> BDT
                                                    </label>
                                                    <input type="text" name="paid_amount" id="totalPaid" hidden >

                                                    <label for="due" class="form-label d-block p-2 ">Due : <span
                                                            style="font-family: 'Lucida Sans Typewriter'" class="font-bold"
                                                            id="dueAmount">0.00</span> BDT</label>
                                                    <div class="input-group mb-3 text-right">
                                                        <input type="number" class="form-control" min="0" name="due"
                                                               id="due" hidden>
                                                        <input type="number" class="form-control" min="0"
                                                               id="previous-due" value="{{$salaryInvoice->due}}" hidden>
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
        // JQuery Validation
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                phone_number: "required",
            },
            messages: {
                phone_number: "Phone Number is required",
            }
        });

        let bonus = 0;
        let tax = 0;
        let netSalary = 0;
        let due = 0;

        $("input[type='number']").on('input', function (e) {
            let total = Number($('#salary').val());

            bonus = Number($('#bonus').val());
            let overTime = Number($('#overTime').val());

            let payingAmount = Number($('#paid_amount').val() )

            //for tax
            let taxAmount = Number($("#tax").val());
            tax =  Math.ceil((total * taxAmount) / 100);

            let netTotal = total + bonus + overTime


            let paidAmount = Number($("#previouslyPaid").val());
            let totalPaid = Number(paidAmount + payingAmount)

            netSalary = Math.ceil(netTotal - tax)
            due = Number(netSalary - totalPaid)


            $('#netSalary').val(netSalary)
            $('#net-salary').text(netSalary)


            $('#tax-amount').text(tax)
            $('#calculated_tax').val(tax)


            $('#paidAmount').text(totalPaid)

            $('#totalPaid').val(totalPaid)



            if(due <= 0){
                $('#dueAmount').text(0)
                $('#due').val(0)
            }else {
                $('#dueAmount').text(due)
                $('#due').val(due)
            }
        })

        //get patient by PID
        $(document).ready(function () {
            let previousTax = $('#previous_tax').val()
            $('#tax-amount').text(previousTax)
            $('#calculated_tax').val(previousTax)

            let previousNetSalary = $('#net-Salary').val()
            $('#net-salary').text(previousNetSalary)
            $('#netSalary').val(previousNetSalary)

            let previousDue = $('#previous-due').val()
            $('#dueAmount').text(previousDue)
            $('#due').val(previousDue)



            $('#paidAmount').text($("#previouslyPaid").val())
            $('#totalPaid').val($("#previouslyPaid").val())

            $("#phone_number").keyup(function (e) {
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
                    })
                    .catch(err => {
                        console.log(err)
                    })

            })
        })

    </script>
@endpush

