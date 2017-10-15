@extends('layouts.app')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
@endsection
@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <div class="view-title"><h2>User Group Information</h2></div>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="module">
                        <div class="module-inner">
                            <div class="side-bar">


                                <nav class="side-menu">
                                    <ul class="nav nav-tabs nav-tabs-theme-2 tablist">
                                        <li><a href="#memebers" role="presentation" aria-controls="members" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-users icon"></span>Members</a></li>
                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <div id="memebers" role="tabpanel" class="tab-pane">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Contact Persons</h3>
                                        </div>
                                        <div class="panel-body">
                                            @foreach($userGroup->members as $member)
                                            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                {{--{{$member->name}}--}}


                                                <a class="profile-img" href="{{route('profile-view', [$member->id])}}">
                                                    @if(!is_null($member->profile->profile_pic) && file_exists('storage/'.$member->profile->profile_pic))
                                                        <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$member->profile->profile_pic)}}"/>
                                                    @else
                                                        <img data-name="{{$member->profile->initial}}" data-char-count="2" class="img-profile profile-avatar img-circle img-responsive center-block" />
                                                    @endif
                                                    {{--<img src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                                </a>
                                                <ul class="info list-unstyled">
                                                    <li class="name"><a href="{{route('profile-view', [$member->id])}}">{{$member->name}}</a></li>
                                                    <li class="role">{{$member->role->name or "Not Set"}}</li>
                                                    <li class="email"><a href="mailto:{{$member->email}}">{{$member->email}}</a></li>
                                                    <li class="phone"><a href="tel:{{$member->profile->primary_phone_no}}">{{$member->profile->primary_phone_no}}</a></li>
                                                    @if(!is_null($member->profile->secondary_phone_no))
                                                        <li class="phone"><a href="tel:{{$member->profile->secondary_phone_no}}">{{$member->profile->secondary_phone_no}}</a></li>
                                                    @endif
                                                </ul>

                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


@endsection