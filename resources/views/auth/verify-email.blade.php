<!DOCTYPE html>
<html lang="en">
<head>
    <title>HMS- Verify Email</title>

    <link rel="stylesheet" href="{{asset('assets/css/verification-notice.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/loadingSpinner.css')}}">

    <style>
        body {
            font-family: 'Muli', sans-serif;
        }
    </style>
</head>
<body>
<center class="wrapper" data-link-color="#1188E6"
        data-body-style="font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;">
    <div class="checkmark">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" x="0px" y="0px"
             viewBox="0, 0, 100, 100" id="checkmark">
                <g transform="">
                    <circle class="path" fill="none" stroke="#7DB0D5" stroke-width="2" stroke-miterlimit="10" cx="50" cy="50" r="44"/>
                    <circle class="fill" fill="none" stroke="#7DB0D5" stroke-width="2" stroke-miterlimit="10" cx="50" cy="50" r="44"/>
                    <polyline class="check" fill="none" stroke="#7DB0D5" stroke-width="8" stroke-linecap="round" stroke-miterlimit="10"
                              points="70,35 45,65 30,52  "/>
                </g>
            </svg>
    </div>
    <div class="webkit">
        <table  class="wrapper">
            <tbody>
            <tr>
                <td>
                    <table  class="outer">
                        <tbody>
                        <tr>
                            <td>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <center>
                                                <table>
                                                    <tr>
                                                        <td>

                                                            <table style="width:100%; max-width:600px;">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="padding:0px 0px 0px 0px; color:#000000; text-align:left;">
                                                                        <table style="padding:30px 20px 30px 20px;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td height="100%">
                                                                                    <table class="column"
                                                                                           style="width:540px; border-spacing:0; border-collapse:collapse; margin:0px 10px 0px 10px;">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td style="padding:0px;margin:0px;border-spacing:0;">
                                                                                                <table style="table-layout: fixed;">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:50px 30px 18px 30px;  text-align:inherit; background-color:#ffffff;"
                                                                                                            height="100%">
                                                                                                            <div>
                                                                                                                <div style="font-family: inherit; text-align: center">
                                                                                                                    <span style="font-size: 43px; padding: 9px;">Thanks for signing up !&nbsp;</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <table style="table-layout: fixed;">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:18px 30px 18px 30px; line-height:22px; text-align:inherit; background-color:#ffffff;"
                                                                                                            height="100%">
                                                                                                            <div>

                                                                                                                <div style="font-family: inherit; text-align: center">
                                                                                                                    <span
                                                                                                                        style="font-size: 18px">A verification link has been sent,
                                                                                                                    </span>
                                                                                                                    <span style="font-size: 18px">Please check Email & verify to</span>
                                                                                                                    <span style="color: #000000; font-size: 18px; font-family: arial,helvetica,sans-serif"> get access to the system</span>
                                                                                                                    <span style="font-size: 18px">.</span>
                                                                                                                </div>
                                                                                                                <div style="font-family: inherit; text-align: center">

                                                                                                                    <span style="line-height:50px;color: #ffbe00; font-size: 18px"><strong>Thank you!&nbsp;</strong></span>
                                                                                                                    <br>
                                                                                                                    <span style="color: #000000; font-size: 18px;">To resend the verification email again, Please click the button below</span>
                                                                                                                </div>
                                                                                                                <div></div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>

                                                                                                <table
                                                                                                    style="table-layout:fixed;"
                                                                                                    width="100%">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center"
                                                                                                            bgcolor="#ffffff"
                                                                                                            class="outer-td"
                                                                                                            style="padding:0px 0px 0px 0px;">
                                                                                                            <table
                                                                                                                border="0"
                                                                                                                cellpadding="0"
                                                                                                                cellspacing="0"
                                                                                                                class="wrapper-mobile"
                                                                                                                style="text-align:center;">
                                                                                                                <tbody>
                                                                                                                <tr>
                                                                                                                    <td align="center"
                                                                                                                        bgcolor="#ffbe00"
                                                                                                                        class="inner-td"
                                                                                                                        style="border-radius:6px; font-size:16px; text-align:center; background-color:inherit;">
                                                                                                                        <form
                                                                                                                            action="{{route('verification.send')}}"
                                                                                                                            method="POST">
                                                                                                                            @csrf
                                                                                                                            <button
                                                                                                                                type="submit"
                                                                                                                                style="background-color:#ffbe00; border:1px solid #ffbe00; border-color:#ffbe00; border-radius:0px; border-width:1px; color:#000000; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;">
                                                                                                                                Resend
                                                                                                                                Verification
                                                                                                                                Link
                                                                                                                            </button>
                                                                                                                        </form>
                                                                                                                        <a href="{{route('login-page')}}" style="background-color:dodgerblue;
                                                                                                                                                                 border-radius:10px;
                                                                                                                                                                 color:white;
                                                                                                                                                                 display:inline-block;
                                                                                                                                                                 font-size:14px;
                                                                                                                                                                 font-weight:normal;
                                                                                                                                                                 letter-spacing:0px;
                                                                                                                                                                 line-height:normal;
                                                                                                                                                                 padding:12px 40px 12px 40px;
                                                                                                                                                                 text-align:center;
                                                                                                                                                                 border-style:solid;
                                                                                                                                                                 font-family:inherit;">Back
                                                                                                                        </a>

{{--                                                                                                                        <a href=""--}}
{{--                                                                                                                           style="background-color:#ffbe00; border:1px solid #ffbe00; border-color:#ffbe00; border-radius:0px; border-width:1px; color:#000000; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;"--}}
{{--                                                                                                                           target="_blank">Verify--}}
{{--                                                                                                                            Email--}}
{{--                                                                                                                            Now</a>--}}

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <table class="module"
                                                                                                       border="0"
                                                                                                       cellpadding="0"
                                                                                                       cellspacing="0"
                                                                                                       width="100%"
                                                                                                       style="table-layout: fixed;">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0px 0px 50px 0px;"
                                                                                                            bgcolor="#ffffff">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>

                                                                                                <table width="100%"
                                                                                                       style="table-layout: fixed;">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:22px 0px 30px 0px; color: white; text-align: center;"
                                                                                                            bgcolor="6E6E6E">
                                                                                                            <x-footer-section></x-footer-section>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
{{--                                                                        <div style="font-family:'Lucida Sans Typewriter'; color:#444444; font-size:12px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;">--}}
{{--                                                                            <x-footer-section></x-footer-section>--}}
{{--                                                                        </div>--}}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </center>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</center>

<script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('assets/js/loadingSpinner.js')}}"></script>
</body>
</html>

