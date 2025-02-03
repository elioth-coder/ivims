<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="margin: 0; padding: 0;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
        }

        @media(print) {
            #insurance_details {
                display: block !important;
                margin: 0;
            }
        }

        .business, .date_issued, .inception_date, .expiry_date, .model, .make, .color, .mv_file_no, .plate_no, .serial_no, .liability_limit, .premium {
            margin-top: 5px;

            font-size: 14px;
            font-weight: bold;
            /* color: #06402B; */
            color: #000;
            position: absolute;
            left: 70px;
            top: 360px;
            /* background-color: white; */
            width: 100px;
            text-align: center;
            line-height: 11pt;
        }

        .inception_date, .expiry_date {
            top: 313px;
        }

        .inception_date, .date_issued, .business {
            left: 385px;
            width: 160px;
        }

        .business {
            top: 235px;
        }

        .date_issued {
            top: 268px;
        }

        .expiry_date {
            left: 547px;
            width: 168px;
        }

        .make, .serial_no {
            left: 175px;
            width: 125px;
        }

        .color {
            left: 442px;
            width: 136px;
        }

        .mv_file_no {
            left: 582px;
            width: 134px;
        }

        .liability_limit, .premium {
            top: 417px;
            left: 515px;
            width: 170px;
            text-align: right;
            padding-left: 30px;
        }

        .liability_limit {
            /* font-size: 16px; */
        }

        .premium {
            top: 450px;
        }

        .plate_no, .serial_no {
            top: 388px;
        }

        .assured_name, .assured_address {
            font-size: 14px;
            font-weight: bold;
            /* color: #06402B; */
            color: #000;
            position: absolute;
            left: 70px;
            top: 245px;
            /* background-color: white; */
            width: 310px;
            text-align: center;
            line-height: 11pt;
        }

        .assured_address {
            top: 275px;
        }

        .policy_no, .coc_no, .or_no {
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
            /* color: #06402B; */
            color: #000;
            position: absolute;
            right: 80px;
            top: 205px;
        }

        .coc_no {
            top: 235px;
        }

        .or_no {
            top: 265px;
        }

        .qr_code {
            position: absolute;
            right: 65px;
            bottom: 80px;
            height: 110px;
            width: 110px;
        }

        .paper-container {
            position:relative;
            height: 11.7in;
            width: 8.3in;
            border: 1px solid black;
            margin: 0;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <div style="text-align: center; position:relative;" id="insurance_details">
        <img style="position: absolute; top: 0; left: 0;" src="{{ public_path('images/security-paper.png') }}" alt="">
        <div class="policy_no">{{ $authentication->policy_no }}</div>
        <div class="coc_no">{{ $authentication->coc_no }}</div>
        <div class="or_no">{{ $authentication->or_no }}</div>
        <div class="assured_name uppercase">{{ $authentication->first_name }} {{ $authentication->last_name }} {{ $authentication->suffix }}</div>
        <div class="assured_address uppercase">{{ $authentication->municipality }}, {{ $authentication->province }}</div>
        <div class="business">{{ $authentication->business }}</div>
        <div class="date_issued">{{ $authentication->date_issued }}</div>
        <div class="inception_date">{{ $authentication->inception_date }}</div>
        <div class="expiry_date">{{ $authentication->expiry_date }}</div>
        <div class="model">{{ $authentication->model }}</div>
        <div class="make">{{ $authentication->make }}</div>
        <div class="color">{{ $authentication->color }}</div>
        <div class="mv_file_no">{{ $authentication->mv_file_no }}</div>
        <div class="plate_no">{{ $authentication->plate_no }}</div>
        <div class="serial_no">{{ $authentication->serial_no }}</div>
        <div class="liability_limit">P{{ number_format(100000 ,2) }}</div>
        <div class="premium">P{{ number_format($authentication->premium, 2) }}</div>
        <div class="qr_code text-center">
            <div class="mx-auto" style="width: 120px;">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::size(110)->generate($authentication->coc_no)) !!}" alt="QR Code">
            </div>
        </div>
    </div>
</body>
</html>
