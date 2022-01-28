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
                            <h3 class="text-capitalize">{{'Test Report Information'}}</h3>
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row mt-4" style="border-style:solid ">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                            <textarea name="template" id="data"
                                                      hidden>{{ $report->report }}</textarea>
                                        <div id="toolbar"></div>
                                        <div id="editor"></div>
                                    </div>
                                </div>
                                <div id="converted-view" style="white-space: pre" class="ql-viewer" hidden></div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end mb-2">
                            <button type="button" id="save" class="btn btn-primary me-1 mb-1" onclick="modifyPdf()">
                                Create Pdf
                            </button>
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
            quill.disable()
            let value = $('#data').val()
            let data = JSON.parse(value)
            quill.setContents(data)
            var delta = quill.getContents();
            let obj = {}
            const converter = new window.QuillDeltaToHtmlConverter(delta.ops, obj)
            console.log(converter.convert())
            let html = converter.convert()
            document.getElementById('converted-view').innerHTML = html;

        })

        async function modifyPdf() {
            var printWindow = window.open('', '', 'height=800,width=800');
            printWindow.document.write('<html><head>');
            printWindow.document.write('</head><body style="white-space: pre;margin-top: 50px">');
            printWindow.document.write(document.getElementById('converted-view').innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print()
        }
    </script>
@endpush
