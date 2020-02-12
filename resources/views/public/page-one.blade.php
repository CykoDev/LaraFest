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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- CSS -->
    <link href="{{ asset('css/public.css') }}" rel="stylesheet" type="text/css">

    {{-- custom and/or component scripts --}}
    @stack('styles')
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ config('app.name', 'LaraFest') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Signup</a>
                    </li>
                @endguest
            </ul>
        </div>
        </div>
    </nav>


    <!-- Header -->
    <header class="masthead" style="
            background: url({{ asset('img/public/backwithmorecarsbaby.jpg') }});
            background-size: cover;
            ">
        <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">{{ config('app.name', 'Laravel CMS') }}</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Back for 2020</h2>
            <a href="#about" class="btn btn-info js-scroll-trigger">Get Started</a>
        </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">NUST Literary Festival</h2>
            <p class="text-white-50">
                National Literary Festival, two years ago, achieved its envisioned goal; to revitalise the love and renew the thirst of literature among the youth. Filled with numerous talks, competitions and workshops, it was a fest one of its kind.
            </p>
            </div>
        </div>
        <img src="" class="img-fluid" alt="">
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects-section bg-light">
        <div class="container">

        <!-- Featured Project Row -->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
            <div class="col-xl-8 col-lg-7">
            <img class="img-fluid mb-3 mb-lg-0" src="" alt="">
            </div>
            <div class="col-xl-4 col-lg-5">
            <div class="featured-text text-center text-lg-left">
                <br><br>
                <h4>NLC Returns for 2020</h4>
                <br><br>
            </div>
            </div>
        </div>

        <!-- Project One Row -->
        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
            <div class="col-lg-6">
            <img class="img-fluid" src="{{ asset('img/public/wontfailagainipromise.jpg') }}" alt="">
            </div>
            <div class="col-lg-6">
            <div class="bg-black text-center h-100 project">
                <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-left">
                    <h4 class="text-white">The Beauty of Literature</h4>
                    <p class="mb-0 text-white-50">Emulating the very legacy, NLC brings to you NLF 2.0. Once again the Gurus of literature and the eager young minds of tomorrow will come under a single roof; celebrating literature, sucking out the marrow of life.</p>
                    <hr class="d-none d-lg-block mb-0 ml-0">
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Project Two Row -->
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-6">
            <img class="img-fluid" src="{{ asset('img/public/backagainfor2020.jpg') }}" alt="">
            </div>
            <div class="col-lg-6 order-lg-first">
            <div class="bg-black text-center h-100 project">
                <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-right">
                    <h4 class="text-white">The Festivities</h4>
                    <p class="mb-0 text-white-50">With social events, workshops, art exhibitions, competitions and interactive sessions, we promise you a bigger, better, more rejuvenating, fulfilling and a colorful experience than ever before.</p>
                    <hr class="d-none d-lg-block mb-0 mr-0">
                </div>
                </div>
            </div>
            </div>
        </div>

        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section bg-black">
        <div class="container">

        <div class="row">

            <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
                <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50">NUST H-12 Islamabad, Pakistan</div>
                </div>
            </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
                <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                    <a href="mailto:literarycircle.nust@gmail.com">literarycircle.nust@gmail.com</a>
                </div>
                </div>
            </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
                <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">+92 321 1354050</div>
                </div>
            </div>
            </div>
        </div>

        <div class="social d-flex justify-content-center">
            <a href="mailto:literarycircle.nust@gmail.com" class="mx-2">
                <i class="fas fa-envelope"></i>
            </a>
            <a href="https://www.facebook.com/National-Literary-Festival-105613350971918/" class="mx-2">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.linkedin.com/in/nust-literary-circle-070707138/" class="mx-2">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
        <div class="container">
            Copyright &copy; {{ config('app.name', 'LaraFest') }} {{   now()->year   }}
        </div>
    </footer>

    <script src="{{ asset('js/public.js') }}"></script>

    {{-- custom and/or component scripts --}}
    @stack('scripts')

</body>

</html>
