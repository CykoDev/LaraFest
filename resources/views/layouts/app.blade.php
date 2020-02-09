<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel CMS') }}</title>

    <!-- Favicon -->
    <link href="{{ asset('img') }}/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/portal.css') }}" rel="stylesheet" type="text/css">

    {{-- custom and/or component scripts --}}
    @stack('styles')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column pb-5">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbars.navbar')
                @yield('content')
            </div>

        </div>

    </div>

    <script src="{{ asset('js/portal.js') }}"></script>

    {{-- custom and/or component scripts --}}
    @stack('scripts')

</body>

</html>
