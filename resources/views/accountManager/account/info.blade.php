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
                            <h3 class="text-capitalize">Account Information</h3>
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
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="account_name" class="mb-2">Account Name</label></b>
                                    <p>{{ ucwords( $account->account_name ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="type" class="mb-2">Type</label></b>
                                    <p>{{ ucwords( $account->type ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="description" class="mb-2">Reference Number</label></b>
                                    <p>{{ ucwords($account->reference_number ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    <br>
                                    @if($account->status == "PAID")
                                        <p class="badge bg-success mb-1">{{ ucwords("Paid" ?? 'N/A') }}</p>
                                    @elseif($account->status == "UNPAID")
                                        <p class="badge bg-warning mb-1">{{ucwords("Unpaid" ?? 'N/A')}}</p>
                                    @else
                                        <p class="badge bg-danger mb-1">{{ucwords("Due" ?? 'N/A')}}</p>
                                    @endif
                                </div>

                                @if($account->description != null   )
                                    @if(preg_match('/(test-)/',$account->reference_number ))
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="description" class="mb-2">Description</label></b>
                                            <p id="separated"></p>
                                            <input type="text" id="test_description" value="{{ $account->description}}" hidden>
                                        </div>
                                    @elseif(preg_match('/(salary-)/',$account->reference_number ))
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="description" class="mb-2">Description</label></b>
                                            <p id="separated"></p>
                                            <input type="text" id="salary_description" value="{{ $account->description}}" hidden>
                                        </div>
                                    @elseif(preg_match('/(billing-)/',$account->reference_number ))
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="description" class="mb-2">Description</label></b>
                                            <p id="separated"></p>
                                            <input type="text" id="billing_description" value="{{ $account->description}}" hidden>
                                        </div>
                                    @else
                                        <div class="col-sm-12 col-md-6">
                                            <b><label for="description" class="mb-2">Description</label></b>
                                            <p>{{$account->description}}</p>
                                        </div>
                                    @endif
                                @endif
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
            let description = $('#test_description').val()
            console.log(description)
            if (description !== undefined) {
                let parseDescriptions = JSON.parse(description)
                $("#separated").html(parseDescriptions.map((description) => `<span>${description.title + ' (' + `<b>` + description.price + ' BDT ' + `</b>` + ')'}</span>`).join(', '))
            }

            let salaryDescription = $('#salary_description').val()
            console.log(salaryDescription)
            if (salaryDescription !== undefined) {
                let parsed = JSON.parse(salaryDescription)
                $("#separated").html(parsed.map((salaryDescription) => `<span>${`<b>` + 'Overtime: ' + `</b>` + salaryDescription.overtime + ' BDT' + `<br>` + `<b>` + 'Bonus: ' + `</b>` + salaryDescription.bonus + ' BDT ' + `</br>` + `<b>` + 'Tax: ' + `</b>` + salaryDescription.tax + ' BDT ' + `<br>` + `<b>` + 'Paid Amount: ' + `</b>` + salaryDescription.paid_amount + ' BDT ' + `</br>` + `<b>` + 'Due: ' + `</b>` + salaryDescription.due + ' BDT '}</span>`).join(', '))
            }
            let billingDescription = $('#billing_description').val()
            if (billingDescription !== undefined){
                let parseDescriptions = JSON.parse(billingDescription)
                $("#separated").html(parseDescriptions.map((description) => `<span>${description.title + ' (' + `<b>` + description.price + ' BDT ' + `</b>` + ')'}</span>`).join(', '))
            }
        })
    </script>
@endpush
