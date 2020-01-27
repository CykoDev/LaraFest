<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <ul class="navbar-nav mr-auto">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{ route('home') }}" role="button" >
                <span class="ml-2 d-none d-lg-inline text-gray-600">{{ config('app.name', 'Laravel CMS') }}</span>
            </a>
        </li>

    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{ route('home') }}" role="button" >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Home</span>
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{ route('login') }}" role="button" >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Login</span>
            </a>
        </li>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{ route('register') }}" role="button" >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Signup</span>
            </a>
        </li>

    </ul>

</nav>
