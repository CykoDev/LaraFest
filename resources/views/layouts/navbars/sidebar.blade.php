<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel CMS') }}</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    @if (Auth::user()->isAdmin())



    @endif

    @switch(true)
        @case (Auth::user()->isAdmin())
            @include('layouts.navbars.sidebars.admin')
            @break

        @case (Auth::user()->isApplicant())
            @include('layouts.navbars.sidebars.applicant')
            @break

        @case (Auth::user()->isModerator())
            @include('layouts.navbars.sidebars.moderator')
            @break

        @case (Auth::user()->isMonitor())
            @include('layouts.navbars.sidebars.monitor')
            @break
    @endswitch

    <li class="nav-item">
      <a class="nav-link">
        <i class="fas fa-laptop-code"></i>
        <span>Meet The Developers</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
