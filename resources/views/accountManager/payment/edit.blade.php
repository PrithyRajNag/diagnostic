@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Payment Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('payment.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editForm" class="form form-vertical" action="{{route('payment.update', $payment->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="account_id" class="mb-2">Account Name</label>
                                                <select name="account_id" class="form-control select2" disabled>
                                                    @foreach($accounts as $account)
                                                        <option value="{{ $account->id }}" {{$payment->account_id == $account->id ? 'selected' : ''}}>{{ $account->account_name }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('account_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="reference_number" class="mb-2">Reference Number</label>
                                                <input type="text" class="form-control" id="reference_number" name="reference_number" value="{{ ucfirst($payment->reference_number)}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('reference_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="mb-2">Account Created Date</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{$payment->date}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        @if($payment->paid_by != null)
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="pay_to" class="mb-2">Pay To</label>
                                                    <input type="text" class="form-control" id="pay_to" name="pay_to" value="{{$payment->pay_to}}" readonly>
                                                </div>
                                                <span class="text-danger">@error('pay_to'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="paid_by" class="mb-2">Paid By</label>
                                                    <input type="text" class="form-control" id="paid_by" name="paid_by" value="{{$payment->paid_by}}" readonly>
                                                </div>
                                                <span class="text-danger">@error('paid_by'){{ $message }}@enderror</span>
                                            </div>
                                        @endif
                                        @if($payment->vat != 0)
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="vat" class="mb-2">Vat</label>
                                                <input type="number" min="0" class="form-control" id="vat" name="vat" value="{{$payment->vat}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('vat'){{ $message }}@enderror</span>
                                        </div>
                                        @endif
                                        @if($payment->discount != 0)
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="discount" class="mb-2">Discount</label>
                                                <input type="number" min="0" class="form-control" id="discount" name="discount" value="{{$payment->discount}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('discount'){{ $message }}@enderror</span>
                                        </div>
                                        @endif
                                        @if($payment->hospital_discount != 0)
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="hospital_discount" class="mb-2">Hospital Discount</label>
                                                <input type="number" min="0" class="form-control" id="hospital_discount" name="hospital_discount" value="{{$payment->hospital_discount}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('hospital_discount'){{ $message }}@enderror</span>
                                        </div>
                                        @endif
                                        @if($payment->bonus != 0)
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="bonus" class="mb-2">Bonus</label>
                                                <input type="number" min="0" class="form-control" id="bonus" name="bonus" value="{{$payment->bonus}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('bonus'){{ $message }}@enderror</span>
                                        </div>
                                        @endif
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="total" class="mb-2">Total</label>
                                                <input type="number" min="0" class="form-control" id="total" name="total" value="{{$payment->total}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('total'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="paid_amount" class="mb-2">Paid Amount</label>
                                                <input type="number" min="0" class="form-control" id="paid_amount" name="paid_amount" value="{{$payment->paid_amount}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('paid_amount'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="due" class="mb-2">Due</label>
                                                <input type="number" min="0" class="form-control" id="due" name="due" value="{{$payment->due}}" readonly>
                                            </div>
                                            <span class="text-danger">@error('due'){{ $message }}@enderror</span>
                                        </div>
                                        @if($payment->due != 0)
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="total" class="mb-2">Due
                                                        Payment</label>
                                                    <input type="number" class="form-control" min="0" id="new_paid"
                                                           name="new_paid"
                                                           value="">
                                                </div>
                                                <span
                                                    class="text-danger">@error('new_paid'){{ $message }}@enderror</span>
                                            </div>
                                        @endif
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
    $("#editForm").validate({
        errorPlacement: function (error, e) {
            e.parents('.form-group').append(error);
        },
        rules:{
            date: "required",
            total:"required",
            paid_amount:"required",
        },
        messages:{
            date: "Date field is required",
            total: "Total Amount field is required",
            paid_amount: "Paid Amount field is required",
        }
    });

    $('#checkAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });

    $(".select2").select2({
        allowClear: true
    })
    $(document).ready(function () {
        let $due = $('#total').val() - $('#paid_amount').val();
        let $paid = Number($('#paid_amount').val());
        $('#due').val($due);

        $("#new_paid").keyup(function (e) {
            let $d = $due - $('#new_paid').val();
            let $new = $paid + Number($('#new_paid').val());
            $('#due').val($d);
            $('#paid_amount').val($new);
        })
    })
</script>
@endpush

