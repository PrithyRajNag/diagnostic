@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Package</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('package.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" id="createForm" action="{{route('package.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="package_name" class="mb-2"><span class="required">*</span> {{'Package Name'}}</label>
                                                <input type="text" class="form-control" id="package_name" name="package_name" value="{{ old('package_name') }}" placeholder="Package Name"/>
                                            </div>
                                            <span class="text-danger">@error('package_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2">{{'Description'}}</label>
                                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                            </div>
                                            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                        </div>


                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="service_id"  class="mb-2 d-flex align-items-center"><span class="required">*</span>Services</label>
                                                <select name="service_id[]" id="services" class="form-control select2 services" style="width: 100%" multiple required>
                                                    <option hidden value="{{ old('service_id') }}"></option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->service_name }} {{ $service->rate }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <span
                                                class="text-danger">@error('service_id'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group ">
                                                <label for="discount" class="mb-2"><span class="required">*</span> {{'Discount'}}</label>
                                                <div class="input-group">
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="discount" name="discount"
                                                        value="{{ old('discount') }}" onkeyup="calculate_amount(this)"
                                                        placeholder="Discount">
                                                    <span class="input-group-text">%</span>
                                                </div>

                                            </div>
                                            <span class="text-danger">@error('discount'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="amount" class="mb-2"><span class="required">*</span> {{'Amount'}}</label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    id="amount" name="amount"
                                                    value="{{ old('amount') }}"
                                                    placeholder="Amount">
                                            </div>
                                            <span class="text-danger">@error('amount'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="active"
                                                           value="1" @if( old('status')) == "1" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="inactive"
                                                           value="0" @if( old('status')) == "0" ? 'checked' : '' @endif
                                                    required>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" id="total" name="total" hidden>
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
            rules: {
                package_name: "required",
                service_id: "required",
                discount: "required",
                amount: "required",
                status: "required",
            },
            messages: {
                package_name: "Package Name is required",
                service_id: "Service is required",
                discount: "Discount is required",
                amount: "Amount is required",
                status: "Status is required",
            }
        });

        $(".select2").select2({
            allowClear: true
        })

        $(document).ready(function() {
            $('.services').select2();
        });

        $('#services').on('change',function (e) {
            $("input[name*='discount']").val('')
            e.preventDefault();
            let sum = 0
            var selected = $('.services').select2('data');
            for (var i = 0; i <= selected.length-1; i++) {
                let fullValue = selected[i].text.split(" ");
                let value = parseInt(fullValue[fullValue.length-1]);
                sum = value+sum;
            }
            $('#amount').val(sum)
            $('#total').val(sum)
        });
        function calculate_amount() {
            var discount = (Number($("input[name*='discount']").val()) / 100);
            var amount = Number($("input[name*='total']").val());

            var total = Math.ceil(amount - (amount * discount))
            $("input[name*='amount']").val(total);

        }
    </script>
@endpush
