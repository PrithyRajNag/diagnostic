<!DOCTYPE html>
<html lang="en">
<head>
    <title>HMS- Resend Verification Email</title>
    <style>
        .card-body{
            font-family: 'Muli', sans-serif;
            /*text-align: center;*/
            /*padding: 30px;*/
            /*margin-top: 5%;*/
            /*background-color: darkseagreen;*/
            /*height: 50px;*/
            /*margin-left: 348px;*/
            /*margin-right: 320px;*/
            /*font-size: 43px;*/

        }

        .image{
            /*background-color: green;*/
            text-align: center;
            /*display: block;*/
            margin-top: 5%;
           /*float: end;*/
            /*height: 50px;*/
        }


    </style>

    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
{{--    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">--}}


</head>
<body>

<section class="section">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">

                <div class="card-body text-center">
                    <div class="image" >
                        <img style="height: 60px"  src="{{asset('assets/images/resend-email.png')}}" alt="image">
                    </div>
                    <h4 style="color: forestgreen">Verification Link Resend Successfully ! </h4>
                    <span style="font-size: 18px">Please check Email & verify to</span>
                    <span style="font-size: 18px;"> get access to the system</span>
                    <br>
                    <span style="line-height:50px;color: #ffbe00; font-size: 18px"><strong>Thank you!&nbsp;</strong></span>
                </div>


            </div>
        </div>
    </div>
</section>
</body>
</html>
