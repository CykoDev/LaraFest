<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link href="{{ asset('img') }}/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/libs.css') }}" rel="stylesheet" type="text/css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="min-vh-100 d-flex align-items-center">

            <!-- Main Content -->
            <div id="content">
                
                <div class="text-center">
                    <div class="error mx-auto my-auto" data-text="@yield('code')">@yield('code')</div>
                    <p class="lead text-gray-800 mb-5">@yield('message')</p>
                    <p class="text-gray-500 mb-2">It looks like you found a glitch in the matrix...</p>
                    <a href="{{ route('home') }}">&larr; Go To Home</a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>
