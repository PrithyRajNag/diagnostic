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
                            <h3 class="text-capitalize">Payment Information</h3>
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
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="account_id" class="mb-2">Account Name</label></b>
                                    <p>{{ ucwords( $payment->accounts->account_name ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="reference_number" class="mb-2"> Reference Number</label></b>
                                    <p>{{  ucfirst($payment->reference_number) ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="date" class="mb-2">Date</label></b>
                                    <p>{{ ucwords( $payment->payment_date ?? 'N/A') }}</p>
                                </div>
                                @if($payment->due_payment_date != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="date" class="mb-2">Due Payment Date</label></b>
                                        <p>{{  $payment->due_payment_date ?? 'N/A' }}</p>
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="total" class="mb-2">Total (BDT)</label></b>
                                    <p>{{  $payment->total ?? 'N/A' }}</p>
                                </div>
                            @if($payment->vat != 0)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="vat" class="mb-2"></label>VAT (BDT)</b>
                                        <p>{{  $payment->vat ?? 'N/A' }}</p>
                                    </div>
                                @endif
                            @if($payment->discount != 0)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="discount" class="mb-2">Discount (BDT)</label></b>
                                        <p>{{  $payment->discount ?? 'N/A' }}</p>
                                    </div>
                                @endif
                            @if($payment->hospital_discount != 0)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="hospital_discount" class="mb-2">Hospital Discount (BDT)</label></b>
                                        <p>{{  $payment->hospital_discount ?? 'N/A' }}</p>
                                    </div>
                                @endif
                            @if($payment->bonus != 0)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="hospital_discount" class="mb-2">Hospital Discount (BDT)</label></b>
                                        <p>{{  $payment->bonus ?? 'N/A' }}</p>
                                    </div>
                                @endif
                                     <div class="col-sm-12 col-md-6">
                                        <b><label for="paid_amount" class="mb-2">Paid Amount (BDT)</label></b>
                                        <p>{{  $payment->paid_amount ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="due" class="mb-2">Due Amount (BDT)</label></b>
                                        <p>{{  $payment->due ?? 'N/A' }}</p>
                                    </div>
                                @if($payment->pay_to != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="pay_to" class="mb-2"> Pay To</label></b>
                                        <p>{{  ucwords($payment->pay_to) ?? 'N/A' }}</p>
                                    </div>
                                @endif
                                @if($payment->paid_by != null)
                                    <div class="col-sm-12 col-md-6">
                                        <b><label for="pay_to" class="mb-2"> Paid By</label></b>
                                        <p>{{  ucwords($payment->paid_by) ?? 'N/A' }}</p>
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-1">{{'Status'}}</label></b>
                                    <br>
                                    @if($payment->status == 'PAID')
                                        <p class="badge bg-success mb-1">{{ ucwords("paid" ?? 'N/A') }}</p>
                                    @elseif($payment->status == 'UNPAID')
                                        <p class="badge bg-danger mb-1">{{ucwords("Unpaid" ?? 'N/A')}}</p>
                                    @else
                                        <p class="badge bg-warning mb-1">{{ucwords("Due" ?? 'N/A')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
