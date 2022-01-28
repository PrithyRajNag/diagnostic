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
                            <h2>Debit Report</h2>
                            <hr/>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group d-flex">
                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                    <input class="form-check-input" type="radio" name="filter" id="daily"
                                           value="{{ \Carbon\Carbon::now()->toDateString() }}" @if( old('filter')) ==
                                    "{{ \Carbon\Carbon::now()->toDateString() }}" ? 'checked' : '' @endif>
                                    <label class="form-check-label" for="daily">Daily</label>
                                </div>
                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                    <input class="form-check-input " type="radio" name="filter"
                                           id="weekly"
                                           value="{{ \Carbon\Carbon::now()->subDays(6)->toDateString() }}" @if( old('filter'))
                                        == "{{ \Carbon\Carbon::now()->subDays(6)->toDateString() }}" ? 'checked' : '' @endif
                                    >
                                    <label class="form-check-label" for="weekly">Weekly</label>
                                </div>
                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                    <input class="form-check-input " type="radio" name="filter"
                                           id="monthly"
                                           value="{{ \Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString() }}" @if( old('filter'))
                                        ==
                                        "{{ \Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString() }}
                                        " ? 'checked' : '' @endif>
                                    <label class="form-check-label" for="monthly">Monthly</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input " type="radio" name="filter"
                                           id="yearly"
                                           value="{{ \Carbon\Carbon::now()->subMonth(\Carbon\Carbon::now()->subMonth(1)->month)->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString() }}" @if( old('filter'))
                                        ==
                                        "{{ \Carbon\Carbon::now()->subMonth(\Carbon\Carbon::now()->subMonth(1)->month)->toDateString() }}
                                        " ? 'checked' : '' @endif>
                                    <label class="form-check-label" for="yearly">Yearly</label>
                                </div>
                                <input type="text" name="to_date" id="to_date" class="form-control form-select-sm" value="{{\Carbon\Carbon::now()}}" hidden>
                                <span class="text-danger">@error('filter'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="card col-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card-content m-0 p-0">
                                <div class="card-body table-responsive">
                                    <table class='table' style="width: 100%"
                                           id="laravel_datatable">
                                        <thead>
                                        <th>{{'Date'}}</th>
                                        <th>{{'Account Name'}}</th>
                                        <th>{{'Reference Number'}}</th>
                                        <th>{{'Amount'}}</th>
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
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            load_data();
            function load_data(from_date = '', to_date = ''){
                $('#laravel_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("report.debit") }}',
                        data:{from_date:from_date, to_date:to_date }
                    },
                    columns: [
                        {data: 'payment_date', name: 'payment_date'},
                        {data: 'account_name', name: 'account_name'},
                        {data: 'reference_number', name: 'reference_number'},
                        {data: 'amount', name: 'amount'}
                    ]
                });
            }
            $('input[type=radio][name=filter]').click(function(e){
                let from_date = e.target.value;
                let to_date = $('#to_date').val();
                // console.log(to_date)
                if (from_date != '' && to_date != ''){
                    $('#laravel_datatable').DataTable().destroy();
                    load_data(from_date,to_date);
                }
                else{
                    alert('Both Date is required')
                }
            });
            $('#refresh').click(function(){
                $('#from_date').val('');
                $('#to_date').val('');
                $('#laravel_datatable').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endpush
