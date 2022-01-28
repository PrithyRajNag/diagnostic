<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <style>
        .barcode-cell {
            width: 100%;
            padding: 0px;
            float: right;
            vertical-align: middle;
        }
        .font{
            font-family: Lucida Sans Typewriter,Lucida Console,monaco,Bitstream Vera Sans Mono,monospace;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    @foreach($info as $item)
        <div class="barcode-cell">
            <barcode code='{{$item->invoice_number}}' type='C93' height="0.5" class='barcode'}}/>
        </div>
    @endforeach
    <h3 class="header-font" style="text-align: center; background: #eee;">Patient Billing</h3>
    <div>
        <table >
            @foreach($patient as $data)
                <tr>
                    <td style="width: 67%">Name: {{ $data->first_name }}  {{ $data->last_name }}</td>
                    <td style="align:left">Age: {{ $data->age }} Years</td>
                </tr>
                <tr>
                    <td style="width: 67%">Gender: {{ ucfirst($data->gender) }}</td>
                    <td style="align:left">Phone No: {{ $data->phone_no }}</td>
                </tr>
                <tr>
                    <td style="width: 67%">Admit Date: {{ date('d-m-Y',strtotime($data->admit_date)) }}</td>
                    <td style="align:left">Discharge Date: {{ date('d-m-Y',strtotime($data->discharge_date)) ?? date('d-m-Y',strtotime(\Carbon\Carbon::now()->toDateString()))}}</td>
                </tr>
            @endforeach
            @foreach($info as $item)
                <tr>
                    <td style="width: 67%">Issuer: {{ $item->issuer }}</td>
                    <td style="width: 67%">Invoice No: {{ $item->invoice_number }}</td>
                </tr>
        </table>
    </div>
    <div style="margin-top: 10px">
        <table style="font-size: 12px">
            <tr class="heading">
                <td>Bill Of</td>
                <td>Amount</td>
            </tr>
            @foreach($item->details as $data)
                <tr class="item">
                    <td>{{ $data['title'] }}</td>

                    <td class="font">{{ $data['price'] }} BDT</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="margin-top: 10px">
        <table style="font-size: 12px">
            <tr class="heading">
                <td>Billing Details</td>
                <td>Amount</td>
            </tr>
            <tr class="item">
                <td>Total</td>
                <td class="font">{{ $item->total }} BDT</td>
            </tr>
            @if($item->vat != 0)
                <tr class="item">
                    <td>Vat <small>(+)</small></td>
                    <td class="font">{{ $item->vat }} BDT</td>
                </tr>
            @endif
            @if($item->discount != 0)
                <tr class="item">
                    <td>Discount <small>(-)</small></td>
                    <td class="font">{{ $item->discount }} BDT</td>
                </tr>
            @endif
            @if($item->hospital_discount != 0 )
                <tr class="item">
                    <td>Hospital Discount <small>(-)</small></td>
                    <td class="font">{{ $item->hospital_discount }} BDT</td>
                </tr>
            @endif
            <tr class="item">
                <td>Net Total</td>
                <td class="font">{{ $item->net_total }} BDT</td>
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
    @endforeach

    <br>
    <br>
    <hr style="color: black; width: 20%; text-align: right;margin-bottom: 0px">
    <p class="sig"><b>Receiver Signature</b></p>
    <p class="sig font" style="line-height: 1px;color:cornflowerblue;margin: 0px">Printed By
        : {{ auth()->user()->profile->full_name }}</p>

</div>
</body>
