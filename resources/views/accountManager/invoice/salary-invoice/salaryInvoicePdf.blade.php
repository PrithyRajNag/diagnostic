<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu+Mono" />
<meta charset="utf-8">
    <style>
        .barcode-cell {
            width: 100%;
            margin-top: 10px;
            padding: 0px;
           text-align: center;
            vertical-align: middle;
        }
        .font{
            font-family: Lucida Sans Typewriter,Lucida Console,monaco,Bitstream Vera Sans Mono,monospace;
        }

    </style>
</head>
<body>
    <div class="invoice-box">
        <h3 class="header-font" style="text-align: center; background: #eee;">Salary Invoice</h3>
        <div>
            <table>
                <tr>
                    <td style="width: 67%">Name: {{ $profile->first_name }}  {{ $profile->last_name }}</td>
                    <td style="width: 67%">Date: {{ $info->payment_date }}</td>
                </tr>
                <tr>
                    <td style="align:left">Phone No: {{ $profile->phone_number }}</td>
                    <td style="align:left">NID: {{ $profile->nid }}</td>
                </tr>
                <tr>
                    <td style="width: 67%">Issuer: {{ $info->issuer }}</td>
                    <td style="width: 67%">Invoice No: {{ $info->invoice_number }}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 10px">
            <table style="font-size: 12px">
                <tr class="heading">
                    <td>Invoice Of</td>
                    <td>Amount</td>
                </tr>
                <tr class="item">
                    <td> Salary</td>
                    <td class="font">{{$profile->salary}} BDT</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 10px">
            <table style="font-size: 12px">
                <tr class="heading">
                    <td>Details</td>
                    <td>Amount</td>
                </tr>
                <tr class="item">
                    <td>TAX <small>(-)</small></td>
                    <td class="font">{{ $payment->tax }} BDT</td>
                </tr>

                <tr class="item">
                    <td>Bonus <small>(+)</small></td>
                    <td class="font">{{ $payment->bonus }} BDT</td>
                </tr>
                <tr class="item">
                    <td>Net Salary</td>
                    <td class="font">{{ $info->net_salary}} BDT</td>
                </tr>
                <tr class="item">
                    <td>Paid Amount</td>
                    <td class="font">{{ $payment->paid_amount ?? '0' }} BDT</td>
                </tr>
                <tr class="item">
                    <td>Due</td>
                    <td class="font">{{ $payment->due ?? '0' }} BDT</td>
                </tr>
            </table>
        </div>

        <div class="barcode-cell">
            <barcode code='{{$info->invoice_number}}' type='C93' height="0.5"  class='barcode'}}/>
        </div>
        <p class="sig font" style="text-align:center;color:cornflowerblue;margin-top: 20px">Printed By : {{ auth()->user()->profile->full_name }}</p>
    </div>
</body>



