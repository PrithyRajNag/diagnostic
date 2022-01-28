@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Bill</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('bill.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('bill.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="appointment_id" class="mb-2">AID</label>
                                                                <input type="text" class="form-control" name="appointment_id" id="appointment_id" value="{{old('appointment_id')}}"
                                                                placeholder="Appointment ID" >
                                                            </div>
                                                            <span class="text-danger">@error('appointment_id'){{ $message }}@enderror</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="patient_id" class="mb-2">PID</label>
                                                                <input type="text" class="form-control" name="patient_id" id="patient_id" value="{{old('patient_id')}}"
                                                                       placeholder="Patient ID" >
                                                            </div>
                                                            <span class="text-danger">@error('patient_id'){{ $message }}@enderror</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="bill_date" class="mb-2">Bill Date</label>
                                                        <input type="date" class="form-control" name="bill_date" id="bill_date" value="{{old('bill_date')}}">
                                                    </div>
                                                    <span class="text-danger">@error('bill_date'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="mb-2">Patient Name</label>
                                                        <input style=" cursor: not-allowed;" type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Patient Name" disabled>
                                                    </div>
                                                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="dob" class="mb-2">Date of Birth</label>
                                                        <input style=" cursor: not-allowed;" type="date" class="form-control" name="dob" id="dob" value="{{old('dob')}}" disabled>
                                                    </div>
                                                    <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="address" class="mb-2">Address</label>
                                                        <textarea name="address" style=" cursor: not-allowed;"
                                                                  id="address"
                                                                  class="form-control"
                                                                  rows="3"
                                                                  placeholder="Address" disabled></textarea>
                                                    </div>
                                                    <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="gender" class="mb-2">Gender</label>
                                                        <input style=" cursor: not-allowed;" type="text" class="form-control" name="gender" id="gender" value="{{old('gender')}}" disabled>
                                                    </div>
                                                    <span class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="doctor_name" class="mb-2">Doctor Name</label>
                                                        <input style=" cursor: not-allowed;" type="text" class="form-control" name="doctor_name" id="doctor_name" value="{{old('doctor_name')}}" placeholder="Doctor Name" disabled>
                                                    </div>
                                                    <span class="text-danger">@error('doctor_name'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="admission_date" class="mb-2">Admission Date</label>
                                                    <input style=" cursor: not-allowed;" type="text" class="form-control" name="admission_date" id="admission_date" value="{{old('admission_date')}}" placeholder="Admission Date" disabled>
                                                </div>
                                                <span class="text-danger">@error('admission_date'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="package_name" class="mb-2">Package Name</label>
                                                    <input style=" cursor: not-allowed;" type="text" class="form-control" name="package_name" id="package_name" value="{{old('package_name')}}" placeholder="Package Name" disabled>
                                                </div>
                                                <span class="text-danger">@error('package_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="total_days" class="mb-2">Total Days</label>
                                                    <input style=" cursor: not-allowed;" type="text" class="form-control" name="total_days" id="total_days" value="{{old('total_days')}}" placeholder="Total Days" disabled>
                                                </div>
                                                <span class="text-danger">@error('total_days'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="discharge_date" class="mb-2">Discharge Date</label>
                                                    <input style=" cursor: not-allowed;" type="text" class="form-control" name="discharge_date" id="discharge_date" value="{{old('discharge_date')}}" placeholder="Total Days" disabled>
                                                </div>
                                                <span class="text-danger">@error('discharge_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" table table-responsive">
                                    <div>
                                        <h5 class="d-inline" >Service Charges</h5>
                                        <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary float-end">Add</button>
                                    </div>
                                    <table class="table" id="dynamicAddRemove" style="max-width: 100%;">
                                        <thead>
                                        <th>Service Name</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Sub Total</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type="text" name="addMoreInputFields[0][name]" placeholder="Service" class="form-control-sm"/></td>
                                            <td><input type="text" name="addMoreInputFields[0][quantity]" value="1" class="form-control-sm" /></td>
                                            <td><input type="text" name="addMoreInputFields[0][rate]" placeholder="Amount" class="form-control-sm" /></td>
                                            <td><input type="text" name="addMoreInputFields[0][sub_total]" placeholder="0.00" class="form-control-sm" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="divider">
                                            <div class="divider-text">Advance Payment</div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="date" class="mb-2">Date</label>
                                                <input type="text" class="form-control" name="advance_id" id="advance_id" value="{{old('advance_id')}}" placeholder="Admission Date" disabled>
                                            </div>
                                            <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="receipt_no" class="mb-2">Receipt No</label>
                                                <input type="text" class="form-control" name="advance_id" id="advance_id" value="{{old('advance_id')}}" placeholder="Receipt No" disabled>
                                            </div>
                                            <span class="text-danger">@error('receipt_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="amount" class="mb-2">Amount</label>
                                                <input type="text" class="form-control" name="advance_id" id="advance_id" value="{{old('advance_id')}}" placeholder="Amount" disabled>
                                            </div>
                                            <span class="text-danger">@error('advance_id'){{ $message }}@enderror</span>
                                        </div>
                                        <hr>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="payment_method" class="mb-2">Payment Method</label>
                                                <select name="payment_method" id="payment_method" class="form-select">
                                                    <option hidden></option>
                                                    <option value="cash">Cash</option>
                                                    <option value="card">Card</option>
                                                    <option value="cheque">Cheque</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('payment_method'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="card_cheque_no" class="mb-2">Card / Cheque No</label>
                                                <input type="text" class="form-control" name="card_cheque_no" id="card_cheque_no" value="{{old('card_cheque_no')}}" placeholder="Card / Cheque No">
                                            </div>
                                            <span class="text-danger">@error('card_cheque_no'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="receipt_no" class="mb-2">Receipt No</label>
                                                <input type="text" class="form-control" name="receipt_no" id="receipt_no" value="{{old('receipt_no')}}" placeholder="Receipt No">
                                            </div>
                                            <span class="text-danger">@error('receipt_no'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="calculation">
                                    <div class="form-group row">
                                        <label for="total" class="col-sm-6 col-form-label">Total :</label>
                                        <div class="col-sm-6" >
                                            <input type="number" min="0" name="total" id="total" class="form-control" value="{{old('total')}}">
                                        </div>
                                        <span class="text-danger">@error('total'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group row">
                                        <label for="discount" class="col-sm-6 col-form-label">Discount %</label>
                                        <div class="col-sm-6" >
                                            <input type="number" min="0" name="discount" id="discount" class="form-control" value="{{old('discount')}}">
                                        </div>
                                        <span class="text-danger">@error('discount'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tax" class="col-sm-6 col-form-label">TAX %</label>
                                        <div class="col-sm-6" >
                                            <input type="number" min="0" name="tax" id="tax" class="form-control" value="{{old('tax')}}">
                                        </div>
                                        <span class="text-danger">@error('tax'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group row">
                                        <label for="advance_payment" class="col-sm-6 col-form-label">Advance</label>
                                        <div class="col-sm-6" >
                                            <input type="number" min="0" name="advance_payment" id="advance_payment" class="form-control" value="{{old('advance_payment')}}">
                                        </div>
                                        <span class="text-danger">@error('advance_payment'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group row">
                                        <label for="payable" class="col-sm-6 col-form-label">Payable</label>
                                        <div class="col-sm-6" >
                                            <input type="number" min="0" name="payable" id="payable" class="form-control" value="{{old('payable')}}">
                                        </div>
                                        <span class="text-danger">@error('payable'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label for="note" class="mb-2">Note</label>
                                        <textarea name="note"
                                                  id="note"
                                                  class="form-control"
                                                  rows="3"
                                                  placeholder="Note"></textarea>
                                    </div>
                                    <span class="text-danger">@error('note'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="paid"
                                               value="1">
                                        <label class="form-check-label" for="paid">PAID</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="unpaid"
                                               value="0">
                                        <label class="form-check-label" for="unpaid">UNPAID</label>
                                    </div>

                                    <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-2">Submit</button>
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
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr>' +
                '<td><input type="text" name="addMoreInputFields[' + i +
                '][name]" placeholder="Service" class="form-control-sm "/>' +
                '</td>' +
                '<td><input type="text" name="addMoreInputFields[' + i +
                '][quantity]" value="1" class="form-control-sm" />' +
                '</td>' +
                '<td><input type="text" name="addMoreInputFields[' + i +
                '][rate]" placeholder="Amount" class="form-control-sm" />' +
                '</td>'+
                '<td><input type="text" name="addMoreInputFields[' + i +
                '][sub_total]" placeholder="0.00" class="form-control-sm" />' +
                '</td>'+
                '<td style="width: 2px"><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>' +
                '</tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });


    </script>
@endpush
