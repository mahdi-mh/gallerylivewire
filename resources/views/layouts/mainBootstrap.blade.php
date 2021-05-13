<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Test project">
    <meta name="author" content="Mahdi Mohammadi">

    <title>{{env('APP_NAME')}} @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- fontAwesome css -->
    <link href="{{ asset('css/fontAwesome.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles

</head>

<body>

<header>
    @include('layouts.mainTemplate.navbar')
</header>

<main role="main" class="@yield('mainClass')">
    @yield('container')
</main>

@yield('javascript')

@livewireScripts


<script>
    window.addEventListener('swAlert', event => {
        Swal.fire(event.detail)
    })
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js')}}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

</body>
</html>

