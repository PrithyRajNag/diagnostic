@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Test Result Item</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('test-result-item.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="createForm" class="form form-vertical" action="{{route('test-result-item.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="result_category_id" class="mb-2"><span class="required">*</span> Test Result Category Name</label>
                                                <select name="result_category_id" class="form-select select2">
                                                    <option hidden value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">@error('result_category_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                                       placeholder="Title" required>
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label"><span class="required">*</span> Reference</label>
                                                <textarea class="form-control" name="reference" id="reference" rows="2" required>{{ old('reference') }}</textarea>
                                                <span class="text-danger">@error('reference'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="2">{{ old('description') }}</textarea>
                                                <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                </div>
                                </div>
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
            rules:{
                title: "required",
                reference: "required",
                result_category_id: "required",
            },
            messages:{
                title: "Title is required",
                reference: "Reference is required",
                result_category_id: "Result Category is required",
            }
        });
    </script>
@endpush
