<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Sunny House')}} - @yield('title')</title>
    <!-- CSS Vendors -->
    <link rel="stylesheet" href="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{  asset(mix('js/app.js')) }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.mask.js') }}" defer></script>

    {{--Datatable--}}
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/plug-ins/1.10.22/sorting/datetime-moment.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">


    {{--    Table Editable  --}}
    <script src="{{ asset('js/bstable.js') }}" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    {{--    Datepicker  --}}
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"
        integrity="sha512-mVkLPLQVfOWLRlC2ZJuyX5+0XrTlbW2cyAwyqgPkLGxhoaHNSWesYMlcUjX8X+k45YB8q90s88O7sos86636NQ=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

    <!-- import plugin script -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>

    {{--    Functions   --}}
    <script src="{{ asset('/js/functions.js') }}"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset(mix('css/fonts.css')) }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset(mix('css/bootstrap.css'))}}">
    <link rel="stylesheet" href="{{asset(mix('css/app.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/autocomplete.css'))}}">
    <link rel="stylesheet" href="{{asset(mix('css/style.css'))}}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/images/logo/logo.png')}}">

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            height: 257mm;
        }

        .pagecontrato {
            padding: 3cm;
        }

        @page {
            size: A4;
            margin: 1cm 0 0 0;
        }

        @page :first {
            margin: 0 0 1cm 0;
        }

        @page print-adhesion {
            margin: 0 !important;
        }

        @page print-contract {
            margin: 0 !important;
        }

        @page power-of-attorney {
            margin: 0 !important;
        }

        @page receipt-of-payment {
            margin: 0 !important;
        }

        @page technical-certificate {
            margin: 0 !important;
        }

        @page document-request {
            margin: 0 !important;
        }

        .print-adhesion {
            page: print-adhesion;
        }

        .print-contract {
            page: print-contract;
        }

        #power-of-attorney {
            page: power-of-attorney;
        }

        #receipt-of-payment {
            page: receipt-of-payment;
        }

        #technical-certificate {
            page: technical-certificate;
        }

        #request-first-1,
        #request-first-2,
        #request-first-3,
        #request-second-1,
        #request-second-2,
        #request-second-3,
        #request-second-4,
        #request-third-1,
        #request-third-2,
        #request-third-3,
        #request-third-4,
        #request-third-5 {
            page: document-request;
        }

        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
                background-color: #FFF;
            }

            .page {
                margin: 0 !important;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            .btn-print {
                height: 0;
                display: none;
            }

            .dataTables_length, .dataTables_info, #myTable_paginate {
                display: none;
            }

            .print-adhesion .footer-img {
                top: 27.4cm;
            }

            .print-contract .footer-img {
                top: 27.4cm;
            }

            #power-of-attorney .footer-img {
                top: 27.4cm;
            }

            #receipt-of-payment .footer-img {
                top: 27.4cm;
            }

            #receipt-of-payment #img-signature {
                max-width: 60%;
            }
        }

        * {
            font-size: {{$text_font}}px !important;
            font-family: Verdana, serif;
            color: black;
            line-height: {{$line_height}};
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #000000 !important
        }

        .table:not(.table-borderless) thead th {
            border: 1px solid #000000 !important
        }

        .table-active {
            color: black;
        }

        .form-check-input {
            background-color: #fff;
            border: 1.5px solid black;
        }

        .padding-top-10 {
            padding-top: 10px
        }

        .padding-top-20 {
            padding-top: 20px
        }

        .padding-top-30 {
            padding-top: 30px
        }

        .padding-top-40 {
            padding-top: 40px
        }

        .padding-top-50 {
            padding-top: 50px
        }

        .padding-top-70 {
            padding-top: 70px
        }

        .padding-top-75 {
            padding-top: 75px
        }

        .padding-top-80 {
            padding-top: 80px
        }

        .padding-top-90 {
            padding-top: 90px
        }

        .padding-top-100 {
            padding-top: 100px
        }

        .padding-top-130 {
            padding-top: 130px
        }

        .padding-top-150 {
            padding-top: 150px
        }

        .padding-top-200 {
            padding-top: 200px
        }

        .padding-top-230 {
            padding-top: 230px
        }

        .padding-top-250 {
            padding-top: 250px
        }

        .padding-top-300 {
            padding-top: 300px
        }

        div {
            text-align: justify;
            text-justify: inter-word;
        }

        li {
            text-align: justify;
            text-justify: inter-word;

        }

        li span {
            position: relative;
            left: 15px;
        }

        p.font-italic {
            font-family: "Times New Roman", serif;
            font-style: italic;
        }

        .font-size-22 {
            font-size: 22px !important;
        }

        .font-size-20 {
            font-size: 20px !important;
        }

        .font-size-18 {
            font-size: 18px !important;
        }

        .font-size-16 {
            font-size: 16px !important;
        }

        .font-size-15 {
            font-size: 15px !important;
        }

        .font-size-14 {
            font-size: 14px !important;
        }

        .font-size-13 {
            font-size: 13px !important;
        }

        .no-margin-bottom {
            margin-bottom: 0 !important;
        }

        .border-blue th, .border-blue td {
            border: 1px solid #08c !important;
        }

        @media print {
            html, body {
                height: 100%;
            }
        }
    </style>
</head>
<body class="print">
<div id="print">

    <div id="main-content">
        <div class="book">
            {{ $slot }}
        </div>
    </div>
</div>
<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{  asset(mix('js/livewire.js')) }}" defer></script>
<script src="{{ asset('/js/main.js') }}"></script>

</body>
</html>
