<div class="sidebar-heading">
    Moderator Actions
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usermanagement" aria-expanded="true" aria-controls="usermanagement">
        <i class="fas fa-users"></i>
        <span>View User Info</span>
    </a>
    <div id="usermanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('users.index-role', 'applicant') }}">View Applicants</a>
            <a class="collapse-item" href="{{ route('roles.index') }}">View User Roles</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('packages.index') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>View Packages</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#eventmanagement" aria-expanded="true" aria-controls="eventmanagement">
        <i class="fas fa-calendar-alt"></i>
        <span>Manage Events</span>
    </a>
    <div id="eventmanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('events.index') }}">View Events</a>
            <a class="collapse-item" href="{{ route('events.create') }}">Create Event</a>
            <a class="collapse-item" href="{{ route('types.index') }}">View Event Types</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('media.index') }}">
        <i class="fas fa-images"></i>
        <span>View Photos</span>
    </a>
</li>
