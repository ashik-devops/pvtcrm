@extends('layouts.app')

@section('after-head-style')

@endsection


@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <h2 class="view-title">{{$company->name}}</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module">
                        <div class="module-inner">
                            <div class="side-bar">
                                <div class="user-info">
{{--                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                    <ul class="meta list list-unstyled">
                                        <li class="name">{{$company->name}}
                                            <label class="label label-info">
                                                <h3>{{ucfirst( implode(', ', [$default_customer->first_name, $default_customer->last_name])}}</h3>
                                                <address>
                                                    <p>{{$default_customer->getDefaultAddress()}}</p>
                                                </address>
                                            </label>
                                        </li>
                                        <li class="email"><a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                                        <li class="activity">Last logged in: Today at 2:18pm</li>
                                    </ul>
                                </div>

                                <nav class="side-menu">
                                    <ul class="nav">
                                        <li class="active"><a href="user-profile.html"><span class="pe-icon pe-7s-user icon"></span> Profile</a></li>
                                        <li><a href="user-settings.html"><span class="pe-icon pe-7s-config icon"></span> Settings</a></li>
                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-footer-scripts')

@endsection