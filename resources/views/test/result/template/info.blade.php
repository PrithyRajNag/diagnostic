@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xs-12 order-md-1 order-last ">
                            <h3 class="text-capitalize">{{'Test Report Template Information'}}</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="lab_id" class="mb-2">Test Item Name</label></b>
                                    <p>{{ ucwords($template->testItems->test_name ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="title" class="mb-2">Report Name</label></b>
                                    <p>{{ ucwords($template->title ?? 'N/A') }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <b><label for="status" class="mb-2">{{'Status'}}</label></b>
                                    @if($template->status == 1)
                                        <p>{{ ucwords("Active" ?? 'N/A') }}</p>
                                    @else
                                        <p>{{ucwords("Inactive" ?? 'N/A')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-4" style="border-style:solid ">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                            <textarea name="template" id="data"
                                                      hidden>{{ $template->template }}</textarea>
                                            <div id="toolbar"></div>
                                            <div id="editor"></div>
                                        </div>
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
        let quill = new Quill('#editor', {
            modules: {
                syntax: false,
            },
            placeholder: 'Enter Your Text Here...',
            theme: 'bubble',
            disabled: true,
        });

        $(document).ready(function () {
            let value = $('#data').val()
            let da = JSON.parse(value)
            quill.setContents(da)
            quill.disable()
        })
    </script>
@endpush
