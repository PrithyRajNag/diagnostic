@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Create Medicine</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('medicine.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{route('medicine.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="mb-2">Medicine Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                                >
                                            </div>
                                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="category_id" class="mb-2">Category Name</label>
                                                <select name="category_id" class="form-select">
                                                    <option hidden value=""></option>
                                                    {{--                                                    @foreach($bedTypes as $bedType)--}}
                                                    {{--                                                        <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>--}}
                                                    {{--                                                    @endforeach--}}
                                                </select>
                                            </fieldset>
                                            <span class="text-danger">@error('category_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2">Description</label>
                                                <textarea class="form-control"
                                                          name="description" id="description"
                                                          rows="2"
                                                          required>{{ old("description")  }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="mb-2">Price</label>
                                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}"
                                                >
                                            </div>
                                            <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="manufactured_by" class="mb-2">Manufactured By</label>
                                                <input type="text" class="form-control" id="manufactured_by" name="manufactured_by" value="{{ old('manufactured_by') }}"
                                                >
                                            </div>
                                            <span class="text-danger">@error('manufactured_by'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="1">
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="0">
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
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


    </script>
@endpush
