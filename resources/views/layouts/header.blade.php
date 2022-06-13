<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport csrf-token" content="width=device-width, initial-scale=1 {{ csrf_token() }}">
    <title>Diagnostic</title>
    @if(Helper::favicon() != null)
        @if(Helper::favicon()['favicon'] != null)
            <link rel="shortcut icon" type="image/jpg/png/svg/jpeg" href="{{asset("storage/favicons/".Helper::favicon()['favicon'])}}"/>
        @else
            <link rel="shortcut icon" type="image/jpg/png/svg/jpeg" href="{{asset("assets/images/logo_ial.png")}}"/>
        @endif
    @else
        <link rel="shortcut icon" type="image/jpg/png/svg/jpeg" href="{{asset("assets/images/logo_ial.pnggit sat")}}"/>
    @endif

{{--    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />--}}
{{--    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carter+One" />--}}
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Old+Standard+TT" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Jura" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Gruppo" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cuprum" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nova+Square" />
    <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/quill.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/chartjs/Chart.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">

</head>

<body>
<div id="app">
