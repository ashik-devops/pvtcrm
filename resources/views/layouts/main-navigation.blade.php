@section('main-nav')
<div class="main-nav-wrapper">
    <nav id="main-nav" class="main-nav js-cloak">
        <ul id="menu">
            <li class="{{Nav::isRoute('dashboard',"active")}}">
                <a href="/">
                    <span aria-hidden="true" class="icon icon_house_alt"></span>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <li class="{{Nav::isRoute('calendar',"active")}}" >
                <a href="{{route('calendar')}}">
                    <span aria-hidden="true" class="fa fa-calendar"></span>
                    <span class="nav-label">Calendar</span>
                </a>
            </li>
            <li class="{{Nav::isRoute('account-index',"active")}}">
                <a href="{{route('account-index')}}">
                    <span aria-hidden="true" class="icon icon_building_alt"></span>
                    <span class="nav-label">Accounts</span>
                </a>
            </li>
            <li class="{{Nav::isRoute('customer-index',"active")}}">
                <a href="{{route('customer-index')}}">
                    <span aria-hidden="true" class="icon icon_group"></span>
                    <span class="nav-label">Customers</span>
                </a>
            </li>
            <li class="{{Nav::isRoute('task-index',"active")}}">
                <a href="{{route('task-index')}}">
                    <span aria-hidden="true" class="fa fa-tasks"></span>
                    <span class="nav-label">Tasks</span>
                </a>
            </li>
            <li class="{{Nav::isRoute('appointment-index',"active")}}">
                <a href="{{route('appointment-index')}}">
                    <span aria-hidden="true" class="fa fa-calendar-check-o"></span>
                    <span class="nav-label">Appointments</span>
                </a>
            </li>
            @can('index', \App\User::class)
            <li class="{{Nav::urlDoesContain('user',"active")}}">
                <a href="'#'">
                    <span aria-hidden="true" class="icon icon_group"></span>
                    <span class="nav-label">Users</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li  class="{{Nav::isRoute('users-index',"active")}}">
                        <a href="{{route('users-index')}}">
                            <span class="nav-label">All Users</span>
                        </a>
                    </li>
                    <li  class="{{Nav::isRoute('role-index',"active")}}">
                        <a href="{{route('role-index')}}">
                            <span class="nav-label">All Roles</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endcan
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin() || \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                <li class="{{Nav::isRoute('activities-index',"active")}}">
                    <a href="{{route('activities-index')}}">
                        <span aria-hidden="true" class="fa fa-space-shuttle"></span>
                        <span class="nav-label">Activity Log</span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
</div>
@endsection