@section('main-nav')
<div class="main-nav-wrapper">
    <nav id="main-nav" class="main-nav js-cloak">
        <ul id="menu">
            <li  {{ Request::is('/') ? ' class="active"' : null }}>
                <a href="/">
                    <span aria-hidden="true" class="icon icon_house_alt"></span>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li {{ Request::is('task-index') ? ' class="active"' : null }}>
                <a href="{{route('task-index')}}">
                    <span aria-hidden="true" class="fa fa-tasks"></span>
                    <span class="nav-label">Tasks</span>
                </a>
            </li>
            <li {{ Request::is('appointment-index') ? ' class="active"' : null }}>
                <a href="{{route('appointment-index')}}">
                    <span aria-hidden="true" class="fa fa-calendar-check-o"></span>
                    <span class="nav-label">Appointments</span>
                </a>
            </li>
            <li {{ Request::is('calendar') ? ' class="active"' : null }}>
                <a href="{{route('calendar')}}">
                    <span aria-hidden="true" class="fa fa-calendar"></span>
                    <span class="nav-label">Calendar</span>
                </a>
            </li>
            <li {{ Request::is('companies') ? ' class="active"' : null }}>
                <a href="{{route('company-index')}}">
                    <span aria-hidden="true" class="icon icon_building_alt"></span>
                    <span class="nav-label">Companies</span>
                </a>
            </li>
            <li {{ Request::is('customers') ? ' class="active"' : null }}>
                <a href="{{route('customer-index')}}">
                    <span aria-hidden="true" class="icon icon_group"></span>
                    <span class="nav-label">Customers</span>
                </a>
            </li>
            <li {{ Request::is('users') ? ' class="active"' : null }}>
                <a href="{{route('users-index')}}">
                    <span aria-hidden="true" class="icon icon_group"></span>
                    <span class="nav-label">Users</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endsection