@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">Edit Test Report Template</h3>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('test-report-template.index')}}" class="btn-sm btn-primary">BACK</a>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" id="editForm" action="{{route('test-report-template.update', $template->uuid)}}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="test_item_id" class="mb-2"><span
                                                        class="required">*</span> Test Item Name</label>
                                                <select name="test_item_id" class="form-select select2">
                                                    @foreach($items as $item)
                                                        <option hidden value="{{old('test_item_id', $item->id)}}" {{$template->test_item_id == $item->id ? 'selected' : ''}}>{{$item->test_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span
                                                class="text-danger">@error('test_item_id'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2"><span class="required">*</span> Report Name</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                       value="{{ ucwords($template->title) }}"
                                                       placeholder="Title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status"><span class="required">*</span> Status</label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="1" {{($template->status == "1") ? "checked" : ""}}>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="0" {{($template->status == "0") ? "checked" : ""}}>
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <textarea name="template" id="data" hidden>{{ $template->template }}</textarea>
                                                <div id="toolbar"></div>
                                                <div id="editor">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mb-2">
                                        <button type="submit" id="save" class="btn btn-primary me-1 mb-1">Update</button>
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
            rules:{
                title: "required",
                test_item_id: "required",
                template: "required",
                status: "required",
            },
            messages:{
                title: "Title is required",
                test_item_id: "Test Item is required",
                template: "Template is required",
                status: "Status is required",
            }
        });

        var quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    ['link', 'image', 'video', 'formula'],
                    [{'color': []}],
                    [{'font': []}],
                ]
            },
            placeholder: 'Enter Your Text Here...',
            theme: 'snow',
        });

        $(document).ready(function () {
            let value = $('#data').val()
            let data = JSON.parse(value)
            quill.setContents(data)
        })

        $('#save').click(function () {
            window.data = quill.getContents();

            let text = JSON.stringify(window.data)
            $('#data').val(text)
        })
    </script>
@endpush
