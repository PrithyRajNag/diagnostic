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
                            <h3 class="text-capitalize">Role Information</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('role.index')}}" class="btn-sm btn-primary">BACK</a>
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
                                    <b><label for="title" class="mb-2">Title</label></b>
                                    <p>{{ ucwords( $role->title?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="description" class="mb-2">Description</label></b>
                                    <p>{{ ucwords( $role->description ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="service" class="mb-2">Permission</label></b>
                                    <div>
                                    @foreach($role->permissions as $permission)
                                        <a href="{{ route('permission.show',$permission->uuid) }}" class="badge bg-success mb-1">{{ ucwords( $permission->title ?? 'N/A') }}</a>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    @if($role->status == 1)
                                        <p>{{ ucwords("Active" ?? 'N/A') }}</p>
                                    @else
                                        <p>{{ucwords("Inactive" ?? 'N/A')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
