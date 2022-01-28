@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Patient Billing Invoice</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('patient.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @if($invoice == null)
                                <form id="createForm" class="form form-vertical"
                                      action="{{route('patient-billing-invoice.store')}}" method="POST">
                                    @csrf
                                    @else
                                        <form id="createForm" class="form form-vertical"
                                              action="{{route('patient-billing-invoice.update',$invoice->uuid)}}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')
                                            @endif
                                            <div class="form-body">
                                                <input type="text" value="{{$patient->uuid}}" name="p_uuid" hidden>
                                                <input type="text" value="0" name="bed_package_amount" hidden>
                                                @if($patient->package != null)
                                                    <div class="row">
                                                        <div class=" my-2">
                                                            <label for="package_information"
                                                                   class="mt-2 font-weight-bolder">Package
                                                                Information</label>
                                                            <hr style="margin: 10px 0px">
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 d-flex">
                                                            <label class="mt-2" style="width: 50%;font-weight: bold">Package
                                                                Name: </label>
                                                            <input type="text" class="form-control" style="width: 50%"
                                                                   name="package_name[]"
                                                                   value="{{$patient->package->package_name}}" readonly>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 d-flex">
                                                            <label class="mt-2 font-weight-bolder"
                                                                   style="width: 50%;font-weight: bold">Package
                                                                Price: </label>
                                                            <input type="text" name="package_price[]" id="package_price"
                                                                   class="form-control"
                                                                   style="width: 50%"
                                                                   value="{{$patient->package->amount}}" readonly>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="text" name="package_price[]" id="package_price"
                                                           class="form-control"
                                                           style="width: 50%"
                                                           value="0" hidden>
                                                @endif


                                                <div class="row">
                                                    <input type="text" min="0" name="total_bed_price" value="0" hidden>
                                                    @if(count($bed_assigned)>0)
                                                        <div class=" my-2 bed_list">
                                                            <label for="bed_information"
                                                                   class="mt-2 font-weight-bolder">Bed
                                                                Information</label>
                                                            <hr style="margin: 10px 0px">

                                                        </div>
                                                        <div class="col-12 d-flex mb-3">
                                                            <div style="width: 20%;font-weight: bold"
                                                                 class="text-center">
                                                                Bed Number
                                                            </div>
                                                            <div style="width: 20%;font-weight: bold"
                                                                 class="text-center">
                                                                Assigned Date
                                                            </div>
                                                            <div style="width: 20%;font-weight: bold"
                                                                 class="text-center">
                                                                Unassigned Date
                                                            </div>
                                                            <div style="width: 20%;font-weight: bold"
                                                                 class="text-center">
                                                                Price(Per Day)
                                                            </div>
                                                            <div style="width: 20%;font-weight: bold"
                                                                 class="text-center">
                                                                Price(Total)
                                                            </div>
                                                        </div>
                                                        @for($i=0; $i<=count($bed_assigned)-1 ; $i++)
                                                <div class="d-flex bed-info">
                                                                <div
                                                                    style="width: 19%;margin-right: 1%;margin-bottom: 5px"
                                                                    class="">
                                                                    <select class="form-select select2 form-select-sm bed" disabled>
                                                                        @foreach($beds as $bed)
                                                                            <option
                                                                                value="{{ $bed->bed_number }}" {{ $bed_assigned[$i]->bed_list_id == $bed->id ? 'selected' : ''}}>{{ $bed->bed_number }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div
                                                                    style="width: 19%;margin-right: 1%;margin-bottom: 5px">
                                                                    <input type="text"
                                                                           value="{{ $bed_assigned[$i]->time ?? '' }}"
                                                                           name="assign_time[]"
                                                                           class="form-control" readonly>
                                                                </div>
                                                                <div
                                                                    style="width: 19%;margin-right: 1%;margin-bottom: 5px">
                                                                    <input type="text" name="unassigned_time[]"
                                                                           value="{{  $bed_unassigned[$i]->time ?? \Illuminate\Support\Carbon::now() }}"
                                                                           class="form-control" readonly>
                                                                </div>
                                                                <div class="bed_cost_per_day d-flex"
                                                                     style="width: 40%;margin-bottom: 5px">
                                                                    <select style="width: 50%" class="form-select form-control select2 " disabled>
                                                                        @foreach($beds as $bed)
                                                                            <option
                                                                                value="{{ $bed->price }}" {{ $bed_assigned[$i]->bed_list_id == $bed->id ? 'selected' : ''}}>{{ $bed->price }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if(((\Carbon\Carbon::parse(date('y-m-d', strtotime($bed_unassigned[$i]->time ?? \Illuminate\Support\Carbon::now()))))->
                                                                                            diffInDays(\Carbon\Carbon::parse(date('y-m-d', strtotime($bed_assigned[$i]->time))))) == 0)
                                                                        <input type="text" name="bed_day[]" id="bed_day"
                                                                               value="1"
                                                                               class="form-control bed_day" hidden>
                                                                    @else
                                                                        <input type="text" name="bed_day[]"
                                                                               value="{{  ((\Carbon\Carbon::parse(date('y-m-d', strtotime($bed_unassigned[$i]->time ?? \Illuminate\Support\Carbon::now()))))->
                                                                                diffInDays(\Carbon\Carbon::parse(date('y-m-d', strtotime($bed_assigned[$i]->time)))))}}"
                                                                               class="form-control bed_day" hidden>
                                                                    @endif
                                                                     <input style="width: 50%;margin-left: 3%" type="number" name="bed_price[]" value=0 class="form-control form-control-sm bed_price" readonly>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    @endif
                                                </div>
                                                <div class="service_info mt-3">
                                                    <div class=" my-2">
                                                        <label for="other_information" class="mt-2 font-weight-bolder">Extra
                                                            Charges</label>
                                                        <div class=" float-end">
                                                            <button
                                                                class="btn btn-sm btn-success add-service-row-btn add_field_button"
                                                                type="button">Add
                                                            </button>
                                                        </div>
                                                        <hr style="margin: 10px 0px">
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class=" ">
                                                            <div
                                                                class="col-12 d-flex mb-3 input-group service-increment">
                                                                <div
                                                                    style="width: 22%;margin-right: 2%;font-weight: bold"
                                                                    class="text-center">
                                                                    Service Name
                                                                </div>
                                                                <div
                                                                    style="width: 22%;margin-right: 2%;font-weight: bold"
                                                                    class="text-center">
                                                                    Service Date
                                                                </div>
                                                                <div
                                                                    style="width: 22%;margin-right: 2%;font-weight: bold"
                                                                    class="text-center">
                                                                    Amount
                                                                </div>
                                                                <div
                                                                    style="width: 22%;margin-right: 2%;font-weight: bold"
                                                                    class="text-center">
                                                                    Price
                                                                </div>
                                                                <input name="total_service_price" min="0"
                                                                       id="total_service_price"
                                                                       type="text" value="0" hidden>
                                                            </div>
                                                            @if($patient_services != null)
                                                                @for($i=0; $i<=count($patient_services)-1 ; $i++)
                                                                    <div class="control-group input-group "
                                                                         style="margin-top:10px">
                                                                        <div style="width: 22%;margin-right: 2%">
                                                                            <select name="service_id[]"
                                                                                    class="form-select select2 taken_services"
                                                                                    disabled>
                                                                                @foreach($services as $service)
                                                                                    <option
                                                                                        value="{{ $service->id }}-{{ $service->service_name }}" {{ $patient_services[$i]->service_id == $service->id ? 'selected' : ''}}>{{ $service->service_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div style="width: 22%;margin-right: 2%">
                                                                            <input type="date" name="service_date[]"
                                                                                   value="{{ $patient_services[$i]->service_date }}"
                                                                                   class="form-control" readonly>
                                                                        </div>
                                                                        <div style="width: 22%;margin-right: 2%">
                                                                            <input type="number" name="service_count[]"
                                                                                   value="{{ $patient_services[$i]->count }}"
                                                                                   min="1"
                                                                                   class="form-control count" readonly>
                                                                        </div>
                                                                        <div style="width: 22%;margin-right: 2%">
                                                                            <input type="number" name="service_price[]"
                                                                                   min="0"
                                                                                   value="{{ $patient_services[$i]->amount }}"
                                                                                   class="form-control service_price"
                                                                                   readonly>
                                                                        </div>

                                                                        <div style="width: 4%">
                                                                            <button
                                                                                class="btn  btn-danger  dlt-service-row-btn px-3 py-2"
                                                                                type="button">X
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endfor
                                                            @endif
                                                            <div class="clone hide service-group" id="service-group">
                                                                <div class="control-group input-group "
                                                                     style="margin-top:10px">
                                                                    <div style="width: 22%;margin-right: 2%">
                                                                        <select name="service_id[]"
                                                                                id="service_id-1"
                                                                                class="form-control select2 services">
                                                                            <option hidden
                                                                                    value="{{ old('service_id') }}"></option>
                                                                            @foreach($services as $service)
                                                                                <option
                                                                                    value="{{ $service->id }}-{{ $service->service_name }}"
                                                                                    data-value="{{ $service->rate }}">{{ $service->service_name }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div style="width: 22%;margin-right: 2%">
                                                                        <input type="date" name="service_date[]"
                                                                               id="service_date-1"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div style="width: 22%;margin-right: 2%">
                                                                        <input type="number" name="service_count[]"
                                                                               value="1"
                                                                               id="service_count-1" min="1"
                                                                               class="form-control count">
                                                                    </div>
                                                                    <div style="width: 22%;margin-right: 2%">
                                                                        <input type="number" name="service_price[]"
                                                                               id="service_price-1"
                                                                               value="0" min="0"
                                                                               class="form-control service_price">
                                                                    </div>

                                                                    <div style="width: 4%">
                                                                        <button
                                                                            class="btn  btn-danger remove_field px-3 py-2"
                                                                            type="button">X
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="calculation">
                                                    <div class="form-group row">
                                                        <label for="total" class="col-sm-6 col-form-label">Total
                                                            :</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" min="0" name="total_amount" id="total"
                                                                   class="form-control" value="{{old('total')}}"
                                                                   readonly>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('total'){{ $message }}@enderror</span>
                                                    </div>
                                                    @if($payment != null && $payment->vat != 0)
                                                        <div class="form-group row">
                                                            <label for="tax" class="col-sm-6 col-form-label">VAT Amount</label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" id="vat"
                                                                           class="form-control" value="{{ $payment->vat }}"
                                                                    >
                                                                    <span class="input-group-text">BDT</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group row">
                                                            <label for="tax" class="col-sm-6 col-form-label">VAT
                                                                </label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" id="vat" name="vat"
                                                                           class="form-control" value="{{old('vat') ?? 0}}"
                                                                    >
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($payment != null && $payment->discount != 0)
                                                        <div class="form-group row">
                                                            <label for="discount" class="col-sm-6 col-form-label">Discount
                                                                Value</label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" min="0"
                                                                           id="discount"
                                                                           class="form-control"
                                                                           value="{{ $payment->discount ?? 0}}" readonly>
                                                                    <span class="input-group-text">BDT</span>
                                                                </div>
                                                            </div>

                                                            <span
                                                                class="text-danger">@error('discount'){{ $message }}@enderror</span>
                                                        </div>
                                                    @else
                                                        <div class="form-group row">
                                                            <label for="discount" class="col-sm-6 col-form-label">Discount
                                                                </label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" min="0"
                                                                           id="discount"
                                                                           name="discount"
                                                                           class="form-control"
                                                                           value="{{ old('discount') ?? 0}}" >
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>

                                                            <span
                                                                class="text-danger">@error('discount'){{ $message }}@enderror</span>
                                                        </div>
                                                    @endif
                                                    @if($payment != null && $payment->hospital_discount != 0)
                                                        <div class="form-group row">
                                                            <label for="payable" class="col-sm-6 col-form-label">Organization
                                                                Discount</label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" min="0"
                                                                           id="hospital_discount"
                                                                           class="form-control"
                                                                           value="{{ $payment->hospital_discount }}"
                                                                           readonly>
                                                                    <span class="input-group-text">BDT</span>
                                                                </div>
                                                            </div>
                                                            <input type="number" min="0" name="hospital_discount"
                                                                   class="form-control"
                                                                   value="{{ old('hospital_discount') ?? 0}}" hidden>
                                                            <span class="text-danger">@error('hospital_discount'){{ $message }}@enderror</span>
                                                        </div>
                                                    @else
                                                        <div class="form-group row">
                                                            <label for="payable" class="col-sm-6 col-form-label">Organization
                                                                Discount</label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" min="0" name="hospital_discount"
                                                                           id="hospital_discount"
                                                                           class="form-control"
                                                                           value="{{ old('hospital_discount') ?? 0}}">
                                                                    <span class="input-group-text">BDT</span>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger">@error('hospital_discount'){{ $message }}@enderror</span>
                                                        </div>
                                                    @endif
                                                    <div class="form-group row">
                                                        <label for="net_total" class="col-sm-6 col-form-label">Net Total
                                                            :</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <input type="number" min="0" name="net_total" id="net_total"
                                                                       class="form-control" value="{{old('net_total')}}"
                                                                       readonly>
                                                                <span class="input-group-text">BDT</span>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger">@error('net_total'){{ $message }}@enderror</span>
                                                    </div>
                                                    @if($payment != null)
                                                        <div class="form-group row">
                                                            <label for="given_advance"
                                                                   class="col-sm-6 col-form-label">Advanced
                                                                Amount</label>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <input type="number" min="0" name="given_advance"
                                                                           id="given_advance" class="form-control"
                                                                           value="{{ $payment->paid_amount ?? 0}}" readonly>
                                                                    <span class="input-group-text">BDT</span>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="text-danger">@error('given_advance'){{ $message }}@enderror</span>
                                                        </div>
                                                    @else
                                                        <div class="col-sm-6">
                                                            <input type="number" min="0" name="given_advance"
                                                                   id="given_advance" class="form-control"
                                                                   value="0" hidden>
                                                        </div>
                                                    @endif
                                                    <div class="form-group row">
                                                        <label for="paid_amount"
                                                               class="col-sm-6 col-form-label">Paid Amount</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <input type="number" min="0" name="paid_amount"
                                                                       id="paid_amount" class="form-control"
                                                                       value="{{old('paid_amount') ?? 0}}">
                                                                <span class="input-group-text">BDT</span>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-danger">@error('paid_amount'){{ $message }}@enderror</span>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="due" class="col-sm-6 col-form-label">Due</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <input type="number" min="0" name="due" id="due"
                                                                       class="form-control" value="{{old('due') ?? 0}}"
                                                                       readonly>
                                                                <span class="input-group-text">BDT</span>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger">@error('due'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label for="note" class="mb-2">Note</label>
                                                        <textarea name="note"
                                                                  id="note"
                                                                  class="form-control"
                                                                  rows="3"
                                                                  placeholder="Note"></textarea>
                                                        <span
                                                            class="text-danger">@error('note'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <input type="checkbox" class="me-1" id="discharge" name="discharge" value="YES">
                                                        <label for="discharge" style="font-family: Cuprum; ">Patient Is Being Discharged</label>
                                                    </div>
                                                </div>
                                                <input type="number" min="0" name="net" id="net"
                                                       class="form-control" hidden>
                                                <input type="number" min="0" name="gross" id="gross"
                                                       class="form-control" hidden>
                                                <input type="number" min="0" name="vat_amount" id="vat_amount"
                                                       class="form-control" value="0" hidden>
                                                <input type="number" min="0" name="discount_amount" id="discount_amount"
                                                       class="form-control" value="0" hidden>
                                                <input type="number" min="0" name="all_paid" id="all_paid"
                                                       class="form-control" hidden>
                                                <div class="col-12 d-flex justify-content-end mb-2">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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

        $(document).ready(function () {
            $(".bed").each(function () {
                let bed = $(this).find(':selected').val()
                let html = $(".bed_list")
                $(html).append(
                    '<div style="width: 22%;margin-right: 2%">' +
                    '<input type="text" name="bed_name[]" value="' + bed + '" class="form-control" hidden>' +
                    '</div>')
            })
            $(".bed_cost_per_day").each(function () {
                let cost = $(this).find(':selected').val()
                let day = $(this).children('.bed_day').val()
                let price = cost * day
                let html = $(this).children('.bed_price').val(price)
            })
            $(".taken_services").each(function () {
                let taken_service = $(this).find(':selected').val()
                let html = $(".service-increment")
                $(html).append(
                    '<div style="width: 22%;margin-right: 2%">' +
                    '<input type="text" name="service_id[]" value="' + taken_service + '" class="form-control" hidden>' +
                    '</div>')
                calculate_service_price()
            })


            let bed_price = 0;
            let package_price = 0;
            let service_price = Number($("input[name*='total_service_price']").val())
            if (document.getElementsByName("bed_price[]").length > 0) {
                let inps = document.querySelectorAll('.bed_price');
                let totals = {};

                for (let i = 0; i < inps.length; i++) {
                    totals[inps[i].name] = (totals[inps[i].name] || 0) + Number(inps[i].value);
                }
                $("input[name*='total_bed_price']").val(totals[inps[i].name])

                bed_price = Number($("input[name*='total_bed_price']").val())
            }
            if (document.getElementsByName("package_price[]").length > 0) {
                package_price = Number($("#package_price").val())
            }

            let total_price = bed_price + package_price + service_price
            $("input[name*='total_amount']").val(total_price)
            $("input[name*='net_total']").val(total_price)
            $("input[name*='net']").val(total_price)
            $("input[name*='gross']").val(total_price)
            $("input[name*='bed_package_amount']").val(bed_price + package_price)


            calculate_vat()
            calculate_discount()
            calculate_hospital_discount()
            due()

            let max_fields = 20; //maximum input boxes allowed
            let wrapper = $(".service-group"); //Fields wrapper
            let add_button = $(".add_field_button"); //Add button ID

            let x = 1; //initial text box count
            $(add_button).click(function (e) { //on add input button click

                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="control-group input-group " style="margin-top:10px"> ' +
                        '<div style="width: 22%;margin-right: 2%">' +
                        '<select name="service_id[]" id="service_id-' + x + '" class="form-control select2 services"><option hidden value="{{ old('service_id') }}"></option>@foreach($services as $service)<option value="{{ $service->id }}-{{ $service->service_name }}" data-value="{{ $service->rate }}">{{ $service->service_name }} </option>@endforeach</select>' +
                        '</div>' +
                        '<div style="width: 22%;margin-right: 2%">' +
                        '<input type="date" name="service_date[]" id="service_date-' + x + '" class="form-control">' +
                        '</div>' +
                        '<div style="width: 22%;margin-right: 2%">' +
                        '<input type="number" name="service_count[]" value="1" min="1" id="service_count-' + x + '" class="form-control count">' +
                        '</div>' +
                        '<div style="width: 22%;margin-right: 2%">' +
                        '<input type="number" name="service_price[]" value="0" id="service_price-' + x + '" class="form-control service_price"> ' +
                        '</div>' +
                        '<div style="width: 4%">' +
                        '<button class="btn  btn-danger remove_field px-3 py-2"type="button">X</button>' +
                        '</div>' +
                        '</div>'); // add input boxes.
                }
                $(".input-group .services").select2({
                    allowClear: true
                })
            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                x--;
                calculate_service_price()
            })
            $(".dlt-service-row-btn").on("click", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                x--;
                calculate_service_price()
            })


            $(".service-group").on("change", ".services", function (e) {
                let value = $(this).find(':selected').data('value')
                let val = parseInt(value)
                let field_id = $(this).attr('id')
                let id = field_id.split("-", 2)
                let index_no = id[1]

                $("#service_price-" + index_no).val(val)
                calculate_service_price()
            })
            $(".service-group").on("input", ".count", function (e) {
                let field_id = $(this).attr('id')
                let id = field_id.split("-", 2)
                let index_no = id[1]
                let count = $("#service_count-" + index_no).val()
                // let price = $(this).find(':selected').data('value')
                let price = $("#service_id-" + index_no).find(':selected').data('value')
                let total = count * price
                $("#service_price-" + index_no).val(total)
                calculate_service_price()
            })

            $("#vat").on('input', function (e) {
                let total = (Number($("input[name*='total_amount']").val()))
                let vat = (Number($("#vat").val()) / 100);
                let vat_amount = Math.ceil(total * vat)
                let net_total = total + vat_amount
                $("input[name*='net_total']").val(net_total)
                $("input[name*='net']").val(net_total)
                $("input[name*='vat_amount']").val(vat_amount)
                // console.log(net_total)
                let net = (Number($("#net").val()))
                let discount = (Number($("input[name*='discount']").val()) / 100);
                let discount_amount = Math.ceil(total * discount)
                let net_tot = net - discount_amount
                $("input[name*='net_total']").val(net_tot)
                $("input[name*='gross']").val(net_tot)
                $("input[name*='hospital_discount']").val(0)
                $("input[name*='discount_amount']").val(discount_amount)
                due()
            })

            $("#discount").on('input', function (e) {
                let net = (Number($("#net").val()))
                let total = (Number($("input[name*='total_amount']").val()))
                let discount = (Number($("input[name*='discount']").val()) / 100);
                let discount_amount = Math.ceil(total * discount)
                let net_total = net - discount_amount
                $("input[name*='net_total']").val(net_total)
                $("input[name*='gross']").val(net_total)
                $("input[name*='hospital_discount']").val(0)
                $("input[name*='discount_amount']").val(discount_amount)
                due()
            })

            $("#hospital_discount").on('input', function (e) {
                calculate_hospital_discount()
                due()
            })

            $("input[name*='paid_amount']").on('input', function (e) {
                due()
            })

        })



        function calculate_vat() {
            let total = (Number($("input[name*='total_amount']").val()))
            let vat = (Number($("#vat").val()));
            let net_total = total + vat
            $("input[name*='net_total']").val(net_total)
            $("input[name*='net']").val(net_total)
        }

        function calculate_hospital_discount() {
            let gross = (Number($("input[name*='gross']").val()))
            let hospital_discount = (Number($("#hospital_discount").val()))
            let net_total = (gross - hospital_discount)
            $("input[name*='net_total']").val(net_total)
        }

        function calculate_discount() {
            let net = Number($("#net").val())
            let discount = Number($("#discount").val());
            let net_total = net - discount
            $("input[name*='net_total']").val(net_total)
            $("input[name*='gross']").val(net_total)
            due()
        }

        function calculate_service_price() {
            let sum = 0;
            $(".service_price").each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $("input[name*='total_service_price']").val(sum);
            $("input[name*='discount']").val(0);
            $("input[name*='vat']").val(0);
            calculate_total()
        }

        function calculate_total() {
            let bed_package_amount = Number($("input[name*='bed_package_amount']").val());
            let service_amount = Number($("input[name*='total_service_price']").val());
            let total = bed_package_amount + service_amount

            $("input[name*='total_amount']").val(total)
            $("input[name*='net_total']").val(total)
            $("input[name*='net']").val(total)
            $("input[name*='gross']").val(total)
            due()
        }
        function due() {
            let advance = (Number($("#given_advance").val()))
            let net_total = (Number($("input[name*='net_total']").val()))
            let paid_amount = (Number($("input[name*='paid_amount']").val()))
            let paid = advance + paid_amount
            let due = net_total - paid
            $("input[name*='due']").val(due)
            $("input[name*='all_paid']").val(paid)
        }

    </script>
@endpush
