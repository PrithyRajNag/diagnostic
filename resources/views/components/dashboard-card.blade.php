<div class="col-12 col-md-3">
{{--    <div class="card card-statistic">--}}
{{--        <div class="card-body p-0">--}}
{{--            <div class="d-flex flex-column">--}}
{{--                <div class='px-3 py-3 d-flex justify-content-between'>--}}
{{--                    <h3 class='card-title'>{{$title}}</h3>--}}
{{--                    <div class="card-right d-flex align-items-center">--}}
{{--                        <p>{{$value}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="card {{$cssclass}} flip-card">
        <div class="flip-card-inner p-0 card-body">
            <div class="flip-card-front d-flex flex-column">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <img class="svg" src="{{$svg}}">
                    </div>
                </div>
                <div class="px-3 py-3 d-flex justify-content-between front-margin">
                    <h3 class='card-title text-color'>{{$title}}</h3>
                    <p>{{$value}}</p>
                </div>
            </div>
            <div class="flip-card-back">
                <h4 class="mt-4 text-color">Total {{ucfirst(strtolower($title))}}</h4>
                <h4 class="text-color">{{$value}}</h4>
            </div>
        </div>
    </div>
</div>
