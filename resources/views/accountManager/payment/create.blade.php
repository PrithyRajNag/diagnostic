@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create New Payment</h3>
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
                            <form id="createForm" class="form form-vertical" action="{{route('payment.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="mb-2"><span class="required">*</span> Date</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                                            </div>
                                            <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="account_id" class="mb-2"><span class="required">*</span> Account Name</label>
                                                <select name="account_id" class="form-control select2" required>
                                                    <option hidden value=""></option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('account_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="pay_to" class="mb-2"><span class="required">*</span> Pay To</label>
                                                <input type="text" class="form-control" id="pay_to" name="pay_to" value="{{ old('pay_to') }}" required>
                                            </div>
                                            <span class="text-danger">@error('pay_to'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2">Description</label>
                                                <textarea class="form-control"
                                                          name="description" id="description"
                                                          rows="2"
                                                          >{{ old("description")  }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="amount" class="mb-2"><span class="required">*</span> Amount</label>
                                                <input type="number" min="0" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                                            </div>
                                            <span class="text-danger">@error('amount'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" required>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
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
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
           rules:{
               date: "required",
               account_id: "required",
               pay_to:"required",
               amount:"required",
               status:"required",
           },
            messages:{
                date: "Date field is required",
                account_id: "Account Name field is required",
                pay_to: "Pay to field is required",
                amount: "Amount field is required",
                status: "Status field is required",
            }
        });

        $(".select2").select2({
            allowClear: true
        })

    </script>
@endpush
