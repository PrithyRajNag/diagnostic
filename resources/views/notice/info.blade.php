@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Notice Information</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-12 col-md-6">
                                    <b><label for="title" class="mb-2">Title</label></b>
                                    <p>{{ ucwords( $notice->title ?? '') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="description" class="mb-2">Description</label></b>
                                    <p>{{ ucfirst( $notice->description ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="start_date" class="mb-2">Start Date</label></b>
                                    <p>{{ $notice->start_date ?? '' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="end_date" class="mb-2">End Date</label></b>
                                    <p>{{ $notice->end_date ?? '' }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    @if($notice->status == 1)
                                        <p>{{ ucwords("Active" ?? '') }}</p>
                                    @else
                                        <p>{{ucwords("Inactive" ?? '')}}</p>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <b><label for="document" class="mb-2">Uploaded Document</label></b>
                                    <p>
                                    @if($notice->document != null)
                                            <iframe src="{{asset("storage/documents/".$notice->document)}}" width="100%" height="500px">
                                            </iframe>
                                    @else
                                        {{ __("No Files Available") }}
                                    @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
