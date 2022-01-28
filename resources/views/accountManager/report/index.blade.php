@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if(session('success'))
                    <x-alert type="success" message="{{session('success')}}"></x-alert>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                      <x-alert type="danger" message="{{$error}}"></x-alert>
                    @endforeach
                @endif
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12">
                            <h2>{{'Report'}}</h2>

                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card-content m-0 p-0">
                            <div class="card-body">
                                <table class='table' style="width: 100%"
                                       id="laravel_datatable">
                                    <thead>
                                    <th>SL</th>
                                    <th>{{'Date'}}</th>
                                    <th>{{'Patient ID'}}</th>
                                    <th>{{'Total'}}</th>
                                    <th>{{'VAT'}}</th>
                                    <th>{{'Discount'}}</th>
                                    <th>{{'Grand Total'}}</th>
                                    <th>{{'Paid'}}</th>
                                    <th>{{'Due'}}</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
        $('#laravel_datatable').DataTable({
            "drawCallback": function (settings) {
                feather.replace();
            },
            processing: true,
            serverSide: true,
            "order": [[0, "desc"]],
            ajax: "{{route('report.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'date', name: 'date'},
                {data: 'patient_id', name: 'patient_id'},
                {data: 'vat', name: 'vat'},
                {data: 'total', name: 'total'},
                {data: 'discount', name: 'discount'},
                {data: 'grand_total', name: 'grand_total'},
                {data: 'paid', name: 'paid'},
                {data: 'due', name: 'due'},

                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: false,
                    className: 'text-center'
                },
            ]
        });
    });

    function onDelete(e) {
        console.log(e.id)
        document.getElementById('delForm').setAttribute('action', e.id)

    }
</script>
@endpush
