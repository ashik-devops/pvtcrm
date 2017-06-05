@extends('layouts.app')

@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
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
                                        <li class="name"><h3>{{$company->name}}</h3>
                                            <label class="label label-info"></label></li>
                                        <li>
                                                <address>
                                                    <p>{{implode(', ', [$company->addresses->first()->city, $company->addresses->first()->state, $company->addresses->first()->country, $company->addresses->first()->zip])}}</p>
                                                </address>

                                        </li>
                                        <li class="email"><a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                                        <li class="phone"><a href="tel:{{$company->phone_no}}">{{$company->phone_no}}</a></li>
                                        <li class="website"><a href="{{$company->website}}">{{$company->website}}</a></li>
                                    </ul>
                                </div>

                                <nav class="side-menu">
                                    <ul class="nav nav-tabs nav-tabs-theme-2 tablist">
                                        <li class="active" role="presentation"><a href="#details" aria-controls="details" aria-expanded="true" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-user icon"></span> Details</a></li>
                                        <li role="presentation"><a href="#journals"   aria-controls="journals" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-bookmarks icon"></span> Journals</a></li>
                                        <li><a href="#tasks" role="presentation" aria-controls="tasks" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-note2 icon"></span> Tasks</a></li>
                                        <li><a href="#appointments" role="presentation" aria-controls="appointments" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-date icon"></span> Appointments</a></li>
                                        <li><a href="#addresses" role="presentation" aria-controls="addresses" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-paper-plane icon"></span> Addresses</a></li>
                                        <li><a href="#employees" role="presentation" aria-controls="employees" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-users icon"></span>Contacts</a></li>
                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <div class="tab-content">
                                    <div id="details" role="tabpanel" class="tab-pane active">
                                        <h2 class="title">Company Details</h2>
                                    </div>
                                    <div id="journals" role="tabpanel" class="tab-pane">
                                        <h2 class="title">Journal Entries</h2>
                                    </div>
                                    <div id="tasks" role="tabpanel" class="tab-pane">
                                        <h2 class="title">Tasks</h2>
                                    </div>
                                    <div id="appointments" role="tabpanel" class="tab-pane">
                                        <h2 class="title">Appointments</h2>
                                    </div>
                                    <div id="addresses" role="tabpanel" class="tab-pane">
                                        <h2 class="title">Address Book</h2>
                                    </div>
                                    <div id="employees" role="tabpanel" class="tab-pane">
                                        <h2 class="title">Contact Persons</h2>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-footer-scripts')
    <script src="{{asset('storage/assets/js/member.js')}}"></script>
@endsection