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
                            <h3 class="text-capitalize">Patient History Records</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('patient.show',$patient->uuid)}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                @foreach($histories as $history)
                                    <div style="padding-bottom: 25px">
                                        <div class="col-sm-12 d-flex">
                                            <b><label for="department_id" class="mb-2">History
                                                    Category :</label></b>
                                            <p style="margin-left: 5px">{{ ucfirst(strtolower($history->category)) ?? '' }}</p>
                                        </div>
                                        <div class="col-sm-12 d-flex">
                                            <b><label for="department_id" class="mb-2">History
                                                    Type :</label></b>
                                            <p style="margin-left: 5px">{{ $history->type ?? '' }}</p>
                                        </div>
                                        <div class="col-sm-12 d-flex">
                                            <b><label for="department_id" class="mb-2">Time :</label></b>
                                            <p style="margin-left: 5px">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$history->time)->format('d-m-y') ?? ''}}</p>
                                        </div>
                                        <div class="col-sm-12 d-flex">
                                            <b><label for="department_id" class="mb-2">Description :</label></b>
                                            <p style="margin-left: 5px">{{ $history->description ?? '' }}</p>
                                        </div>
                                        <div class="col-sm-12 d-flex">
                                            <b><label for="department_id" class="mb-2">Updated By :</label></b>
                                            <p style="margin-left: 5px">{{ $history->updated_by ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

