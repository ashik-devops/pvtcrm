@section('header')
<header class="header">
    <div class="branding float-left">
        <h1 class="logo text-center">
            <a href="/">
                <img class="logo-icon" src="{{asset('storage/assets/images/logo-icon.svg')}}" alt="icon" />
                <span class="nav-label">
							<span class="highlight">Pvt</span>CRM
						</span>
            </a>
        </h1>
    </div>
    <div class="topbar">
        <button id="main-nav-toggle" class="main-nav-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <i class="icon fa fa-caret-left"></i>
        </button>
        <div class="search-container">
            <form id="main-search" class="main-search">
                <i id="main-search-toggle" class="fa fa-search icon"></i>
                <div id="main-search-input-wrapper" class="main-search-input-wrapper">
                    <input type="text" id="main-search-input" class="main-search-input form-control" placeholder="Search...">

                    <span id="clear-search" aria-hidden="true" class="fs1 icon icon_close_alt2 clear-search"></span>
                </div>
            </form>
        </div>
        <div class="navbar-tools">
            <div class="utilities-container">
                <div class="utilities">
                    <div id="tour-trigger" class="item item-tour hidden-xs tour-trigger" data-toggle="tooltip" data-placement="bottom" title="Guided Tour"><span class="sr-only">App Tour</span><span class="pe-icon pe-7s-info icon"></span></div>
                    <div class="item item-side-panel">
                        <i id="side-panel-toggle" class="side-panel-toggle panel-hide icon fa fa-signal" data-toggle="tooltip" data-placement="bottom" title="Activities"></i>
                    </div>
                    <div class="item item-notifications">
                        <div class="dropdown-toggle" id="dropdownMenu-notifications" data-toggle="dropdown" aria-expanded="true" role="button">
                            <span class="sr-only">Notifications</span>
                            <span class="pe-icon pe-7s-bell icon" data-toggle="tooltip" data-placement="bottom" title="Notifiations"></span>
                        </div>
                        <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-notifications">
                            <span class="arrow"></span>
                            <div class="notification-items no-overflow">
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img src="{{asset('storage/assets/images/profiles/profile-8.png')}}'" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="name">Albert E</span> <span class="action">replied to your comment</span> on "Maecenas tempus adipiscing consectetur adipiscing elit..."
                                        </a>
                                    </div>
                                    <div class="meta">
                                        2h ago
                                    </div>
                                </div>
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img src="{{asset('storage/assets/images/profiles/profile-7.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="name">Julia A</span> <span class="action">sent you a message</span> "Hey Becky, thanks for doing this natoque penatibus et magnis dis parturient montes..."
                                        </a>
                                    </div>
                                    <div class="meta">
                                        1d ago
                                    </div>
                                </div>
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img src="{{asset('storage/assets/images/profiles/profile-2.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="name">Rachel W</span> <span class="action">shared a file with you</span> "UX mocks for Nike"
                                        </a>
                                    </div>
                                    <div class="meta">
                                        3d ago
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="#">View all notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="item item-messages dropdown">
                        <div class="dropdown-toggle" id="dropdownMenu-messages" data-toggle="dropdown" aria-expanded="true" role="button">
                            <span class="sr-only">Messages</span>
                            <span class="pe-icon pe-7s-mail icon" data-toggle="tooltip" data-placement="bottom" title="Messages"></span>
                        </div>
                        <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-messages">
                            <span class="arrow"></span>
                            <div class="message-items no-overflow">
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img class="profile" src="{{asset('storage/assets/images/profiles/profile-7.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="sender display-block">Julia Arnold</span>
                                            <span class="message-title display-block">Great News</span>
                                            <span class="excerpt display-block">"Hey Becky, thanks for doing this natoque penatibus et magnis dis parturient montes..."</span>
                                        </a>
                                    </div>
                                    <div class="meta">
                                        Apr 6
                                    </div>
                                </div>
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img class="profile" src="{{asset('storage/assets/images/profiles/profile-1.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="sender display-block">Ken Davison</span>
                                            <span class="message-title display-block">RE: Help Needed</span>
                                            <span class="excerpt display-block">"No problem. I can help with the luctus est eu ullamcorper laoreet..."</span>
                                        </a>
                                    </div>
                                    <div class="meta">
                                        Apr 2
                                    </div>
                                </div>
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img class="profile" src="{{asset('storage/assets/images/profiles/profile-4.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="sender display-block">Ryan Baker</span>
                                            <span class="message-title display-block">RE: UX resources for Nike</span>
                                            <span class="excerpt display-block">"Hi Becky, can you send me the wireframes? I need the finalised version..."</span>
                                        </a>
                                    </div>
                                    <div class="meta">
                                        Mar 28
                                    </div>
                                </div>
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img class="profile" src="{{asset('storage/assets/images/profiles/profile-5.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="sender display-block">Sarah West</span>
                                            <span class="message-title display-block">Hello!</span>
                                            <span class="excerpt display-block">"Hello there, lorem ipsum dolor sit amet, consectetur adipiscing elit duis luctus..."</span>
                                        </a>
                                    </div>
                                    <div class="meta">
                                        Mar 25
                                    </div>
                                </div>
                                <div class="item media">
                                    <div class="media-left profile">
                                        <img class="profile" src="{{asset('storage/assets/images/profiles/profile-6.png')}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <span class="sender display-block">Carl Wilson</span>
                                            <span class="message-title display-block">RE: Design Resource</span>
                                            <span class="excerpt display-block">"Hi, Phasellus cursus libero quis ante commodo lobortis duis ac ante..."</span>
                                        </a>
                                    </div>
                                    <div class="meta">
                                        Mar 25
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="user-messages.html">View all messages</a>
                            </div>
                        </div>
                    </div>
                    <div class="item item-more dropdown">
                        <div class="dropdown-toggle" id="dropdownMenu-more" data-toggle="dropdown" aria-expanded="true" role="button">
                            <span class="sr-only">More</span>
                            <span aria-hidden="true" class="fs1 icon icon_grid-3x3" data-toggle="tooltip" data-placement="bottom" title="Settings &amp; Tools"></span>
                        </div>
                        <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-more">
                            <span class="arrow"></span>
                            <h4 class="title">Settings &amp; Tools</h4>
                            <ul class="more-list">
                                <li><a role="menuitem" href="user-settings.html"><span class="pe-icon pe-7s-config icon"></span><br>Settings</a></li>
                                <li><a role="menuitem" href="user-billing.html"><span class="pe-icon pe-7s-wallet icon"></span><br>Billing</a></li>
                                <li><a role="menuitem" href="user-drive.html"><span class="pe-icon pe-7s-pendrive icon"></span><br>Drive</a></li>
                                <li><a role="menuitem" href="user-messages.html"><span class="pe-icon pe-7s-chat icon"></span><br>Messages</a></li>
                                <li><a role="menuitem" href="user-reminders.html"><span class="pe-icon pe-7s-clock icon"></span><br>Reminders</a></li>

                                <li><a role="menuitem" href="help.html"><span class="pe-icon pe-7s-help2 icon"></span><br>Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-container dropdown">
                <div class="dropdown-toggle" id="dropdownMenu-user" data-toggle="dropdown" aria-expanded="true" role="button">
                     @if(!is_null(\Illuminate\Support\Facades\Auth::user()->profile->profile_pic))
                        <img class="img-profile img-circle" src="{{asset('storage/'.\Illuminate\Support\Facades\Auth::user()->profile->profile_pic)}}"/>
                    @else
                        <img data-name="{{\Illuminate\Support\Facades\Auth::user()->profile->initial}}" data-char-count="2" class="img-profile profile-avatar img-circle" />
                    @endif
                    <i class="fa fa-caret-down"></i>
                </div>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-user" >
                    <li><span class="arrow"></span><a role="menuitem" href="{{route('profile-view', \Illuminate\Support\Facades\Auth::user()->id)}}"><span class="pe-icon pe-7s-user icon"></span>My Account</a></li>
                    {{--<li><a role="menuitem" href="pricing.html"><span class="pe-icon pe-7s-paper-plane icon"></span>Upgrade Plan</a></li>--}}
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
@endsection