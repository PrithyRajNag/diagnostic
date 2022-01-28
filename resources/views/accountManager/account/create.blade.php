@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Add Account</h3>
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
                            <form id="createForm" class="form form-vertical" action="{{route('account.store')}}"
                                  method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="account_name" class="mb-2"><span class="required">*</span>
                                                    Account Name</label>
                                                <input type="text" class="form-control" id="account_name"
                                                       name="account_name" value="{{ old('account_name') }}"
                                                       placeholder="Account Name" required>
                                            </div>
                                            <span
                                                class="text-danger">@error('account_name'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="type" class="mb-2"><span class="required">*</span>
                                                    Type</label>
                                                <input type="text" class="form-control" id="type"
                                                           name="type" value="CREDIT" readonly>
                                            </div>
                                            <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="total" class="form-label"><span class="required">*</span> Pay To</label>
                                                <input type="text" class="form-control" name="pay_to"
                                                       id="pay_to" placeholder="Pay To" required>
                                            </div>
                                            <span class="text-danger">@error('paid_to'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2">Description</label>
                                                <textarea class="form-control"
                                                          name="description" id="description"
                                                          rows="2"
                                                >{{ old("description") }}</textarea>
                                            </div>
                                            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="total" class="form-label">Total Amount</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="total"
                                                           id="total" required>
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <span class="text-danger">@error('total'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="paid_amount" class="form-label">Paid Amount</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="paid_amount"
                                                           id="paid_amount" required>
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <span class="text-danger">@error('paid_amount'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="due" class="form-label">Due</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" min="0" name="due"
                                                           id="due" readonly>
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                            <span class="text-danger">@error('due'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
        $('#createForm').validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                account_name: "required",
                type: "required",
                total: "required",
                paid_by: "required",
                paid_amount: "required",
            },
            messages: {
                account_name: "Account Name field is required",
                type: "Type field is required",
                total: "Total Field is required",
                paid_by: "Paid By Field is required",
                paid_amount: "Paid Amount Field is required",
            }
        });
        $(".select2").select2({
            allowClear: true
        })
        $(document).ready(function () {
            let $due = $('#total').val() - $('#paid_amount').val();
            $('#due').val($due);

            $("#paid_amount").keyup(function (e) {
                let $due = $('#total').val() - $('#paid_amount').val();
                $('#due').val($due);
            })
        })
    </script>
@endpush
