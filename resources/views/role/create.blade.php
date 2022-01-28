@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Roles</h3>
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
                            <form class="form form-vertical" id="createForm" action="{{route('role.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                                       placeholder="Title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" name="description"
                                                          rows="3">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                           value="1" @if( old('status')) == "1" ? 'checked' : '' @endif required>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                           value="0" @if( old('status')) == "0" ? 'checked' : '' @endif required>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider">
                                    <div class="divider-text">Permission List</div>
                                </div>
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
                                                    <input  type="checkbox" name="permission_id[]" id="permission" value="{{$permission->id}}">
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
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
            rules: {
                title: "required",
                permission_id: "required",
                status: "required",
            },
            messages: {
                title: "Title is required",
                permission_id: "Permission is required",
                status: "Status is required",
            }
        });
        $('#checkAll').click(function(e){
            var table= $(e.target).closest('table');
            $('td input:checkbox',table).prop('checked',this.checked);
        });
    </script>
@endpush
