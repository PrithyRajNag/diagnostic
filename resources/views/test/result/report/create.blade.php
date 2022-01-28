@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Test Report</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('test-report.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('test-report.store')}}"
                                  enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                                        <h3 class="text-capitalize">Invoice Information</h3>
                                        <hr/>
                                        <input type="text" id="pid" name="pid" hidden>
                                    </div>
                                    <div class="mb-2 p-2">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">PID</span>
                                                    <input type="text" class="form-control" id="invoice_no"
                                                           name="invoice_number"
                                                           value="{{old('invoice_no')}}"
                                                           placeholder="Insert Invoice Number">
                                                </div>
                                                <span class="text-danger">@error('invoice_no'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="mb-2"><span class="required">*</span>
                                                        First Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                           name="first_name" placeholder="First Name" required readonly>
                                                </div>
                                                <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="mb-2"><span class="required">*</span>
                                                        Last Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                           name="last_name" placeholder="Last Name" required readonly>
                                                </div>
                                                <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number" class="mb-2"><span
                                                            class="required">*</span> Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_number"
                                                           name="phone_number" value="{{ old('phone_number') }}"
                                                           placeholder="+88" required readonly>
                                                </div>
                                                <span
                                                    class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="invoice_date" class="mb-2"> Invoice Date</label>
                                                    <input type="date" class="form-control" id="invoice_date"
                                                           name="invoice_date" value="{{ old('invoice_date') }}"
                                                           readonly
                                                    >
                                                </div>
                                                <span
                                                    class="text-danger">@error('invoice_date'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="delivery_date" class="mb-2"><span
                                                            class="required">*</span> Delivery Date</label>
                                                    <input type="date" class="form-control" id="delivery_date"
                                                           name="delivery_date" value="{{ old('delivery_date') }}">
                                                </div>
                                                <span
                                                    class="text-danger">@error('delivery_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                                        <h3 class="text-capitalize">Test Related Information</h3>
                                        <hr/>
                                    </div>
                                    <div class="mb-2 p-2">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="test_item_id" class="mb-2"><span
                                                            class="required">*</span>
                                                        Test Name</label>
                                                    <select name="test_item_id" id="test_item_id" class="form-control select2"
                                                            onchange="findTemplate()"  required>
                                                        <option hidden value=""></option>
                                                        @foreach($testItems as $item)
                                                            <option value="{{$item->id}}">{{$item->test_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span
                                                    class="text-danger">@error('test_item_id'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="report_name" class="mb-2"><span class="required">*</span>
                                                        Report Name</label>
                                                    <input type="text" class="form-control" id="report_name"
                                                           name="report_name" placeholder="Report Name" required readonly>
                                                </div>
                                                <span class="text-danger">@error('report_name'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="status"><span class="required">*</span>
                                                        Status</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="procession"
                                                               value="PROCESSING" @if( old('status')) == "PROCESSING" ? 'checked' : '' @endif
                                                        required>
                                                        <label class="form-check-label" for="procession">Processing</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="done"
                                                               value="DONE" @if( old('status')) == "DONE" ? 'checked' : '' @endif
                                                        required>
                                                        <label class="form-check-label" for="done" >Finished</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                               id="delivered"
                                                               value="DELIVERED" @if( old('status')) == "DELIVERED" ? 'checked' : '' @endif
                                                        required>
                                                        <label class="form-check-label" for="delivered" >Delivered</label>
                                                    </div>
                                                    <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <textarea name="report" id="data" hidden></textarea>
                                                    <div id="toolbar"></div>
                                                    <div id="editor"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="save" class="btn btn-primary me-1 mb-1">Submit</button>
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
                invoice_number: "required",
                first_name: "required",
                last_name: "required",
                phone_number: "required",
                invoice_date: "required",
                delivery_date: "required",
                test_item_id: "required",
                report_name: "required",
                report: "required",
                status: "required",
            },
            messages:{
                invoice_number: "Invoice No is required",
                first_name: "First Name is required",
                last_name: "Last Name is required",
                phone_number: "Phone No is required",
                invoice_date: "Invoice Date is required",
                delivery_date: "Delivery Date is required",
                test_item_id: "Test Name is required",
                report_name: "Report Name is required",
                report: "Report is required",
                status: "Status is required",
            }
        });
        $("#invoice_no").keyup(function (e) {
            let number = e.target.value;
            if (number.length === 0) {
                $('#pid').val('')
                $('#first_name').val('')
                $('#last_name').val('')
                $('#phone_number').val('')
                $('#invoice_date').val('')
                $('#delivery_date').val('')
                const option = new Option('', '', false, true)
                $('.selector').append(option).trigger('change').attr("disabled", false);
            }
            fetch(`/test-report/get-invoice-info/${number}`)
                .then(res => res.json())
                .then(res => {
                    $('#pid').val(res.pid)
                    $('#first_name').val(res.first_name)
                    $('#last_name').val(res.last_name)
                    $('#phone_number').val(res.phone_number)
                    $('#invoice_date').val(res.invoice_date)
                    $('#delivery_date').val(res.delivery_date)
                })
                .catch(err => {
                    console.log(err)
                })
        })

        var quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    ['link', 'image', 'video', 'formula'],
                    [{'color': []}],
                    [{'font': []}],
                ]

            },
            placeholder: 'Enter Your Text Here...',
            theme: 'snow',
        });

        $('#save').click(function () {
            window.data = quill.getContents();

            let text = JSON.stringify(window.data)
            $('#data').val(text)
        })


        function findTemplate() {
            let test = document.getElementById("test_item_id").value;
            fetch(`/test-report/get-template/${test}`)
                .then(res => res.json())
                .then(res => {
                    $('#data').val(res.template)
                    $('#report_name').val(res.title)
                    quill.setContents(JSON.parse(res.template))
                })
                .catch(err => {
                    console.log(err)
                })
        }

    </script>
@endpush
