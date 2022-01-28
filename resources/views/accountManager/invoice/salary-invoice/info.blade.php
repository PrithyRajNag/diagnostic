@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <x-alert type="danger" message="{{$error}}"></x-alert>
                    @endforeach
                @endif
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Salary Invoice Information</h3>
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
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="payment_date" class="mb-2">Payment Date</label></b>
                                    <p>{{ $salaryInvoice->payment_date ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="issuer" class="mb-2">Issuer</label></b>
                                    <p>{{ $salaryInvoice->issuer ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="profile_id" class="mb-2">Employee Name</label></b>
                                    <p>{{ $salaryInvoice->profiles->full_name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="invoice_number" class="mb-2">Invoice Number</label></b>
                                    <p>{{ $salaryInvoice->invoice_number ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="salary" class="mb-2">Salary</label></b>
                                    <p>{{ ucwords( $salaryInvoice->profiles->salary ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="tax" class="mb-2">Tax</label></b>
                                    <p>{{ ucwords($salaryInvoice->tax ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="bonus" class="mb-2">Bonus</label></b>
                                    <p>{{ ucwords($salaryInvoice->bonus ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="overtime" class="mb-2">Overtime</label></b>
                                    <p>{{ ucwords($salaryInvoice->overtime ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="net_salary" class="mb-2">Net Salary</label></b>
                                    <p>{{ ucwords($salaryInvoice->net_salary ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="net_salary" class="mb-2">Paid Amount</label></b>
                                    <p>{{ ucwords($payment->paid_amount ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="due" class="mb-2">Due</label></b>
                                    <p>{{ ucwords($salaryInvoice->due ?? 'N/A') }} BDT</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    <br>
                                    @if($payment->status == "PAID")
                                        <p class="badge bg-success">{{ucwords("Paid" ?? 'N/A') }}</p>
                                    @elseif($payment->status == "UNPAID")
                                        <p class="badge bg-danger">{{ucwords("Unpaid" ?? 'N/A')}}</p>
                                    @else
                                        <span class="badge bg-danger" >{{ucwords("Due" ?? 'N/A')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        $(document).ready(function () {
            let description = $('#salary_description').val()
            let parseDescriptions = JSON.parse(description)
           $("#separated").html(parseDescriptions.map((description) => `${'Due:' + description.due  }`).join(', '))

        })
    </script>
@endpush
