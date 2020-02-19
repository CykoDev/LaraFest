<div class="sidebar-heading">
    Lets Get Started
</div>

<li class="nav-item">
    <a class="nav-link" href="{{ route('packages.browse') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Browse Packages</span>
    </a>
</li>


@if(Auth::user()->data['registration_type'])
    @if(Auth::user()->data['registration_type'] == 'nustian' || Auth::user()->package()->exists())

    <li class="nav-item">
        <a class="nav-link" href="{{ route('events.browse') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Browse Events</span>
        </a>
    </li>

    @endif
@endif

<li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#manageexpenses" aria-expanded="true" aria-controls="manageexpenses">
        <i class="fas fa-funnel-dollar"></i>
        <span>Manage Expenses</span>
    </a>
    <div id="manageexpenses" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">See Your Enrollments</h6>
        <a class="collapse-item" href="{{ route('enrolled.events') }}">Enrolled Events</a>
        <a class="collapse-item" href="{{ route('expenses.summary') }}">Expenses Summary</a>
        <a class="collapse-item" href="{{ route('payment.status') }}">Check Payment Status</a>
    </div>
    </div>
</li>
