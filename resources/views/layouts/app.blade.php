<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sunny House') }} &ndash; @yield('page_title')</title>

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js" integrity="sha512-mVkLPLQVfOWLRlC2ZJuyX5+0XrTlbW2cyAwyqgPkLGxhoaHNSWesYMlcUjX8X+k45YB8q90s88O7sos86636NQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

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

    {{-- Highcharts--}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

</head>
<body>
<div id="app">
    @livewire('layouts.partials.sidebar')
    <div id="main" class='layout-navbar'>
        @livewire('layouts.partials.header')
        <div id="main-content">

            <div class="page-heading">
                <div class="page-title">
                    {{ $header }}
                </div>
                @include('components.flash-message')
                {{ $slot }}
            </div>

            @livewire('layouts.partials.footer')
        </div>
    </div>
</div>
<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{  asset(mix('js/livewire.js')) }}" defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>

</body>
</html>
