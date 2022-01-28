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
                            <h3 class="text-capitalize">Bed Assign Information</h3>
                            <hr/>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('bed-assign.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="bed_number" class="mb-2">Bed Number</label></b>
                                    <div>
                                        <a href="{{ route('bed-list.show',$bedAssign->uuid) }}"
                                           class="badge bg-warning mb-1">{{ ucwords( $bedAssign->bed_number ?? 'N/A') }}</a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="bed_type_id" class="mb-2">Patient Name</label></b>
                                    <div>
                                        <a href="{{ route('patient.show',$bedAssign->patients[0]->uuid) }}"
                                           class="badge bg-success mb-1">{{ ucwords( $bedAssign->patients[0]->full_name ?? 'N/A') }}</a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="bed_type_id" class="mb-2">Start Date</label></b>
                                    <p>{{ $bedAssign->patients[0]->pivot->created_at->format('d/m/Y') ?? '' }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
