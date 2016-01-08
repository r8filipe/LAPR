<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial;
            font-size: 10pt;
            color: #000;
        }

        body {
            width: 100%;
            font-family: Arial;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        #wrapper {
            width: 180mm;
            margin: 0 15mm;
        }

        .page {
            height: 297mm;
            width: 210mm;
            page-break-after: always;
        }

        table {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;

            border-spacing: 0;
            border-collapse: collapse;

        }

        table td {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 2mm;
        }

        table.heading {
            height: 50mm;
        }

        h1.heading {
            font-size: 14pt;
            color: #000;
            font-weight: normal;
        }

        h2.heading {
            font-size: 9pt;
            color: #000;
            font-weight: normal;
        }

        hr {
            color: #ccc;
            background: #ccc;
        }

        #invoice_body {
            height: 149mm;
        }

        #invoice_body, #invoice_total {
            width: 100%;
        }

        #invoice_body table, #invoice_total table {
            width: 100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;

            border-spacing: 0;
            border-collapse: collapse;

            margin-top: 5mm;
        }

        #invoice_body table td, #invoice_total table td {
            text-align: center;
            font-size: 9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 2mm 0;
        }

        #invoice_body table td.mono, #invoice_total table td.mono {
            font-family: monospace;
            text-align: right;
            padding-right: 3mm;
            font-size: 10pt;
        }

        #footer {
            width: 180mm;
            margin: 0 15mm;
            padding-bottom: 3mm;
        }

        #footer table {
            width: 100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;

            background: #eee;

            border-spacing: 0;
            border-collapse: collapse;
        }

        #footer table td {
            width: 25%;
            text-align: center;
            font-size: 9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div id="wrapper">

    <p style="text-align:center; font-weight:bold; padding-top:5mm;">Fatura</p>
    <br/>
    <table class="heading" style="width:100%;">
        <tr>
            <td style="width:80mm;">
                <h1 class="heading">XBOOK</h1>
                <h2 class="heading">
                    123 Happy Street<br/>
                    CoolCity - Pincode<br/>
                    Porto , Portugal<br/>

                    Website : www.website.com<br/>
                    E-mail : info@website.com<br/>
                    Phone : -
                </h2>
            </td>
            <td rowspan="2" valign="top" align="right" style="padding:3mm;">
                <table>
                    <tr>
                        <td>Payment No :</td>
                        <td>{{$payment->id}}</td>
                    </tr>
                    <tr>
                        <td>Dated :</td>
                        <td>{{date('Y m d')}}</td>
                    </tr>
                    <tr>
                        <td>Currency :</td>
                        <td>EUR</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <b>Buyer</b> :<br/>
                {{$payment->payer->payer_info->shipping_address->recipient_name}}<br/>
                {{$payment->payer->payer_info->shipping_address->line1}}
                <br/>
                {{$payment->payer->payer_info->shipping_address->city}}
                - {{$payment->payer->payer_info->shipping_address->postal_code}}
                , {{$payment->payer->payer_info->shipping_address->state}}<br/>
            </td>
        </tr>
    </table>


    <div id="content">

        <div id="invoice_body">
            <table>
                <tr style="background:#eee;">
                    <td style="width:8%;"><b>Pay. No.</b></td>
                    <td><b>Product</b></td>
                    <td style="width:15%;"><b>Quantidade</b></td>
                    <td style="width:15%;"><b>Preço</b></td>
                    <td style="width:15%;"><b>Total</b></td>
                </tr>
            </table>

            <table>
                {{--*/ $val = 0 /*--}}
                @foreach ($payment->transactions[0]->item_list->items as $item) {
                <tr>
                    <td style="width:8%;">{{$item->sku}}</td>
                    <td style="text-align:left; padding-left:10px;">{{$item->description}}
                    </td>
                    <td class="mono" style="width:15%;">{{$item->quantity}}</td>
                    <td style="width:15%;" class="mono">{{$item->price}}</td>
                    <td style="width:15%;" class="mono">{{$item->price}}</td>
                    {{--*/ $val += $item->price /*--}}
                </tr>
                @endforeach

                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="3"></td>
                    <td>Total :</td>
                    <td class="mono">{{$val}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>