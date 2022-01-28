@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Test Item</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('test-item.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" id="editForm"
                                  action="{{route('test-item.update', $testItem->uuid)}}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="category_id" class="mb-2 d-flex align-items-center"><span
                                                        class="required">*</span> Test Category Name</label>
                                                <select name="category_id"
                                                        class="form-select select2">
                                                    @foreach($categories as $category)
                                                        <option hidden
                                                                value="{{old('category_id', $category->id)}}" {{$testItem->category_id == $category->id ? 'selected' : ''}}>{{$category->title}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <span
                                                class="text-danger">@error('category_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="mb-2"><span class="required">*</span> Test Item
                                                    Name</label>
                                                <input type="text" class="form-control" id="test_name" name="test_name"
                                                       value="{{ ucwords($testItem->test_name) }}"
                                                       placeholder="Name">
                                            </div>
                                            <span class="text-danger">@error('test_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="mb-2"><span class="required">*</span>
                                                    Price</label>
                                                <input type="number" class="form-control" min="0" id="price"
                                                       name="price"
                                                       value="{{ $testItem->price }}"
                                                       placeholder="Price">
                                            </div>
                                            <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" name="description"
                                                          rows="3">{{ ucwords($testItem->description) }}</textarea>
                                                <span
                                                    class="text-danger">@error('description'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="active"
                                                           value="1" {{($testItem->status == "1") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="inactive"
                                                           value="0" {{($testItem->status == "0") ? "checked" : ""}}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                                <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mb-2">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    </div>
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
        $("#editForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                category_id: "required",
                test_name: "required",
                price: "required",
                status: "required",

            },
            messages: {
                category_id: "Test Category is required",
                test_name: "Test Name is required",
                price: "Price is required",
                status: "Status is required",
            }
        });

    </script>
@endpush
