<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="{{ route('home') }}" role="button">
                Home
            </a>
        </li>

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="{{ route('dashboard') }}" role="button">
                Dashboard
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
            <img class="img-profile rounded-circle" src="{{ is_null(Auth::user()->photo) ? Auth::user()->defaultImage : Auth::user()->photo->path }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('profile.show') }}">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Edit Profile
            </a>
            <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
            </div>
        </li>
    </ul>

  </nav>
  <!-- End of Topbar -->
