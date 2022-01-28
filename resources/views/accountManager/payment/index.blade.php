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
                            <h2 class="text-capitalize">Payment List</h2>
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
                                    <th>{{'Account Name'}}</th>
                                    <th>{{'Reference Number'}}</th>
                                    <th>{{'Payment Date'}}</th>
                                    <th>{{'Total'}}</th>
                                    <th>{{'Due'}}</th>
                                    <th>{{'Status'}}</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--Danger theme Modal -->
                        <div class="modal fade text-left" id="danger" tabindex="-1"
                             role="dialog" aria-labelledby="myModalLabel120"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                 role="document">
                                <form id="delForm" method="POST" style="width: 100%">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title white" id="myModalLabel120">
                                                Delete</h5>
                                            <button type="button" class="close"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center font-bold">
                                            Are you sure want to delete this?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                    class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancel</span>
                                            </button>
                                            <button type="submit" class="btn btn-danger ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                ajax: "{{route('payment.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'account_name', name: 'account_name'},
                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'payment_date', name: 'payment_date'},
                    {data: 'total', name: 'total'},
                    {data: 'due', name: 'due'},
                    {data: 'status', name: 'status'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ]
            });
        });

        function onDelete(e) {
            console.log(e.id)
            document.getElementById('delForm').setAttribute('action', e.id)

        }
    </script>
@endpush
