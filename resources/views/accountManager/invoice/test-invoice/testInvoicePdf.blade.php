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
            transform: rotate(90deg)
        }
        .font{
            font-family: Lucida Sans Typewriter,Lucida Console,monaco,Bitstream Vera Sans Mono,monospace;
        }

    </style>
</head>
<body>
<div class="invoice-box">

    @foreach($info as $item)
        <div  class="barcode-cell">
            <barcode code='{{$item->invoice_number}}' type='C93' height="0.5" class='barcode'}}/>
        </div>
        <h3 style="text-align: center; background: #eee; font-size: 20px;">Test Invoice</h3>
        <div >
            <table style="font-size: 12px">
                <tr>
                    <td style="width: 67%">Name: {{ $item->first_name }}  {{ $item->last_name }}</td>
                    @foreach($patient as $data)
                        <td style="align:left">Age: {{ $data->age }} Years</td>
                </tr>
                <tr>
                    <td style="width: 67%">Gender: {{ ucfirst($data->gender) }}</td>
                    @endforeach
                    <td style="align:left">Phone No: {{ $item->phone_number }}</td>
                </tr>
                <tr>
                    <td style="width: 67%">Invoice Date: {{ date('d-m-Y',strtotime($item->invoice_date)) }}</td>
                    @if($item->delivery_date != null)
                    <td style="align:left">Delivery Date: {{ date('d-m-Y',strtotime($item->delivery_date))}}</td>
                    @endif
                </tr>
                <tr>
                    <td style="width: 67%">Issuer: {{ $item->issuer }}</td>
                    <td style="align:left">Referred By: {{$referredDoctor->doctors->full_name ?? 'self'}}</td>
                </tr>
                <tr>
                    <td style="width: 67%">Invoice No: {{ $item->invoice_number ?? '' }}</td>
</tr>
            </table>
        </div>
        <div style="margin-top: 10px;">
            <table style="font-size: 12px;">
                <tr class="heading">
                    <td>Test Name</td>
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
        <div style="margin-top: 5px">
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

                @if($item->hospital_discount != 0)
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
                    <td class="font" >{{ $payment->due ?? '0' }} BDT</td>
                </tr>

            </table>
        </div>
    @endforeach

    <br>
    <br>
    <hr style="color: black; width: 25%; text-align: right;margin-bottom: 0px">
    <p class="sig"><b>Receiver Signature</b></p>
    <p class="sig font" style="line-height: 1px;color:cornflowerblue;">Printed By : {{ auth()->user()->profile->full_name }}</p>

</div>
</body>



