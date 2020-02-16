<div class="sidebar-heading">
    Admin Actions
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usermanagement" aria-expanded="true" aria-controls="usermanagement">
        <i class="fas fa-users"></i>
        <span>Manage Users</span>
    </a>
    <div id="usermanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('users.index') }}">View Users</a>
        <a class="collapse-item" href="{{ route('roles.index') }}">View User Roles</a>
        <a class="collapse-item" href="{{ route('users.create') }}">Create User</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#packagemanagement" aria-expanded="true" aria-controls="packagemanagement">
        <i class="fas fa-calendar-alt"></i>
        <span>Manage Packages</span>
    </a>
    <div id="packagemanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('packages.index') }}">View Packages</a>
        <a class="collapse-item" href="{{ route('packages.create') }}">Create Package</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#eventmanagement" aria-expanded="true" aria-controls="eventmanagement">
        <i class="fas fa-calendar-alt"></i>
        <span>Manage Events</span>
    </a>
    <div id="eventmanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('events.index') }}">View Events</a>
        <a class="collapse-item" href="{{ route('types.index') }}">View Event Types</a>
        <a class="collapse-item" href="{{ route('events.create') }}">Create Event</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mediamanagement" aria-expanded="true" aria-controls="mediamanagement">
        <i class="fas fa-images"></i>
        <span>Manage Media</span>
    </a>
    <div id="mediamanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('media.index') }}">View Media</a>
        <a class="collapse-item" href="{{ route('media.create') }}">Upload Media</a>
        </div>
    </div>
</li>

