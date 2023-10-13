<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Vendors -->
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset(mix('css/bootstrap.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/pages/auth.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/app.css')) }}">
    <link rel="stylesheet" href="{{asset(mix('css/style.css')) }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/logo/logo.png') }}">

    <!-- Scripts -->
    <script src="{{asset(mix('js/app.js'))}}" defer></script>
</head>
<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            {{ $slot }}
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <div>{{$image ?? ''}}</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
