<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')   }}">
    <link rel="stylesheet" href="{{ asset('css/app.css')   }}">
    <link rel="stylesheet" href="{{ asset('css/style.css')   }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="/js/Chart.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>

    <title>@yield('title')</title>
</head>
<body>

<div class="container">
    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="{{route('index')}}">Home</a>
            <a class="navbar-brand" href="{{route('iso-codes')}}">Iso Codes(BY SOAP)</a>
          {{--  <a class="navbar-brand" href="{{route('currenciesByDate')}}">Iso Codes(BY SCRAP)</a>--}}
            <a class="navbar-brand" href="{{route('charts')}}">Charts</a>
        </nav>
    </header>
</div>

@yield('content')

@yield('scripts')

</body>
</html>