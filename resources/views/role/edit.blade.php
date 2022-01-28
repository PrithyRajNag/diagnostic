@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if(session('success'))
                    <x-alert type="success" message="{{session('success')}}"></x-alert>
                @endif
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Role</h3>
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
                            <form class="form form-vertical" action="{{route('role.update', $data->uuid)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Title</label>
                                                <input type="text" value="{{$data->title}}"  class="form-control" id="title" name="title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control"  name="description"
                                                          rows="3">{{$data->description}}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="1" {{($data->status == "1") ? "checked" : ""}}>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="0" {{($data->status == "0") ? "checked" : ""}}>
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider">
                                    <div class="divider-text">Assigned Permission List</div>
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
                                <div class="col-12 d-flex justify-content-end mb-2">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                </div>
                            </form>
                            <div class="modal fade text-left" id="delete-modal" tabindex="-1"
                                 role="dialog" aria-labelledby="myModalLabel120"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                     role="document">
                                    <form id="delForm" method="POST" style="width: 100%">
                                        {{ csrf_field() }}
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
    </div>
@endsection
@push('customScripts')

<script>

    $('#checkAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });

    $(".select2").select2({
        allowClear: true
    })

    function onDelete(e) {
        console.log(e.value)
        document.getElementById('delForm').setAttribute('action', e.value)
    }



</script>
@endpush

