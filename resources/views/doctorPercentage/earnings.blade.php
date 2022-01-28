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
                            <h2>Doctor Earning</h2>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class='table table-striped table-hover table-light' id="table1">
                        <thead>
                        <th style="width: 50%">Title</th>
                        <th>Action  <input style="margin-left: 20px" type="checkbox" id="checkAll"><span> (Check All)</span></th>
                        </thead>
                        <tbody>
                        @if(count($permissions)!==0)
                            @foreach($permissions as $permission)

                                <tr>

                                    <td>{{$permission->title ?? ''}}</td>

                                    <td>
                                        <input  type="checkbox" name="permission_id[]" id="permission" value="{{$permission->id}}"
                                        @foreach($data->permissions as $p)
                                            {{  ($permission->id == $p->id ? ' checked' : '')}}
                                            @endforeach
                                        >
                                    </td>

                                </tr>

                            @endforeach
                            <span class="text-danger">@error('permission'){{ $message }}@enderror</span>
                        @else
                            <tr>
                                <td colspan="5">
                                    <h2 class="text-center">No Data Available <i data-feather="frown" ></i> </h2>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>

    </script>
@endpush
