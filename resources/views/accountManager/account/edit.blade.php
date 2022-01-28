@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Account Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('account.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="editForm" class="form form-vertical"
                                  action="{{route('account.update', $account->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="account_name" class="mb-2"><span class="required">*</span>
                                                    Account Name</label>
                                                <input type="text" class="form-control" id="account_name"
                                                       name="account_name" value="{{ucwords($account->account_name)}}"
                                                       placeholder="Account Name" required>
                                            </div>
                                            <span
                                                class="text-danger">@error('account_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="type" class="mb-2"><span class="required">*</span>
                                                    Type</label>
                                                <input type="text" class="form-control" id="type"
                                                       name="type"
                                                       value={{ucfirst(strtolower($account->type))}} readonly>
                                                <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="reference_number" class="mb-2"><span
                                                        class="required">*</span> Reference Number</label>
                                                <input type="text" class="form-control" id="reference_number"
                                                       name="reference_number"
                                                       value="{{ucwords($account->reference_number)}}"
                                                       placeholder="Reference Number" readonly>
                                            </div>
                                            <span
                                                class="text-danger">@error('reference_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
@if(preg_match('/({)/',$account->description ))
                                                <div class="form-group">
                                                    <label for="description" class="mb-2">Description</label>
                                                    <textarea class="form-control" name="description"
                                                              id="decoded_description"
                                                              rows="2"
                                                              readonly>{{ucwords($account->description ?? '')}}</textarea>
                                                    <input type="text" id="test_description"
                                                           value="{{ $account->description}}" hidden/>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label for="description" class="mb-2">Description</label>
                                                    <textarea class="form-control" name="description"
                                                              id="description"
                                                              rows="2">{{ucwords($account->description ?? '')}}</textarea>
                                                </div>
                                            @endif
                                        </div>
                                        @if($payment != null && $payment->paid_by != null)
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="pay_to" class="mb-2"><span class="required">*</span> Pay
                                                        To</label>
                                                    <input type="text" class="form-control" id="pay_to" name="pay_to"
                                                           value="{{ucwords($payment->pay_to) ?? ''}}" required>
                                                </div>
                                                <span class="text-danger">@error('pay_to'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="pay_to" class="mb-2"><span class="required">*</span>
                                                        Paid By</label>
                                                    <input type="text" class="form-control" id="paid_by" name="paid_by"
                                                           value="{{ucwords($payment->paid_by) ?? ''}}" readonly>
                                                </div>
                                                <span class="text-danger">@error('pay_to'){{ $message }}@enderror</span>
                                            </div>
                                        @endif
                                        @if($payment != null)
                                            @if(preg_match('/(paid-)/',$account->reference_number ))
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="total" class="mb-2"><span class="required">*</span>
                                                            Total Amount</label>
                                                        <input type="number" min="0" class="form-control" id="total"
                                                               name="total"
                                                               value="{{$payment->total ?? ''}}" required>
                                                    </div>
                                                    <span
                                                        class="text-danger">@error('total'){{ $message }}@enderror</span>
                                                </div>
                                            @else
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="total" class="mb-2"><span class="required">*</span>
                                                            Total Amount</label>
                                                        <input type="number" min="0" class="form-control" id="total"
                                                               name="total"
                                                               value="{{$payment->total ?? ''}}" required readonly>
                                                    </div>
                                                    <span
                                                        class="text-danger">@error('total'){{ $message }}@enderror</span>
                                                </div>
                                            @endif

                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="total" class="mb-2"><span class="required">*</span> Paid
                                                        Amount</label>
                                                    <input type="number" class="form-control" min="0" id="paid_amount"
                                                           name="paid_amount"
                                                           value="{{$payment->paid_amount ?? ''}}" readonly required>
                                                </div>
                                                <span
                                                    class="text-danger">@error('paid_amount'){{ $message }}@enderror</span>
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
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="total" class="mb-2"><span class="required">*</span> Due</label>
                                                    <input type="number" class="form-control" min="0" id="due"
                                                           name="due"
                                                           value="{{$payment->due ?? ''}}" readonly>
                                                </div>
                                                <span class="text-danger">@error('due'){{ $message }}@enderror</span>
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
        $('#editForm').validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                account_name: "required",
                type: "required",
                total: "required",
                reference_number: "required"
            },
            messages: {
                account_name: "Account Name field is required",
                type: "Type field is required",
                total: "Total Field is required",
                reference_number: "Reference Number is required",
            }
        });

        $('#checkAll').click(function (e) {
            var table = $(e.target).closest('table');
            $('td input:checkbox', table).prop('checked', this.checked);
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

            let description = $('#test_description').val()
            let parseDescriptions = JSON.parse(description)
            $("#decoded_description").html(parseDescriptions.map((description) => description.title + ' (' + description.price + ')').join(', '))
        })


    </script>
@endpush

