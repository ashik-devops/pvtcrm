@extends('layouts.app')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
@endsection
@section('content')

    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <div class="view-title"><h2>Sales Team Details</h2></div>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="module">
                        <div class="module-inner">
                            <div class="side-bar">

                                <div class="sales-team-info">
                                    {{--                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                    <ul class="meta list list-unstyled">
                                        <li class="name"><h3>{{$salesTeam->name}}</h3>


                                    </ul>
                                </div>


                                <div class="sales-team-info">
                                    {{--                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                    <ul class="meta list list-unstyled">
                                        @foreach($salesTeam->managers as $manager)
                                            <li class="name"><h3>{{$manager->name}}</h3>
                                        @endforeach

                                    </ul>
                                </div>



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
                                            <h3 class="panel-title">Members</h3>
                                        </div>
                                        <div class="panel-body">

                                            <div class="col-lg-4 col-md-6 col-sm-12 text-center">



                                                <a href="#">
                                                    <img src="{{asset('storage/assets/images/plus-btn.png')}}" height="100px" width="100px" class="img-circle img-responsive center-block" />
                                                    <h3>Add Member</h3>
                                                </a>


                                            </div>




                                            @foreach($salesTeam->managers as $manager)
                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    {{--{{$member->name}}--}}


                                                    <a class="profile-img" href="{{route('profile-view', [$manager->id])}}">
                                                        @if(!is_null($manager->profile->profile_pic) && file_exists('storage/'.$manager->profile->profile_pic))
                                                            <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$manager->profile->profile_pic)}}"/>
                                                        @else
                                                            <img data-name="{{$manager->profile->initial}}" data-char-count="2" class="img-profile profile-avatar img-circle img-responsive center-block" />
                                                        @endif
                                                        {{--<img src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                                    </a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="{{route('profile-view', [$manager->id])}}">{{$manager->name}}</a></li>
                                                        <li class="role">Team Manager</li>
                                                        <li class="email"><a href="mailto:{{$manager->email}}">{{$manager->email}}</a></li>
                                                        <li class="phone"><a href="tel:{{$manager->profile->primary_phone_no}}">{{$manager->profile->primary_phone_no}}</a></li>
                                                        @if(!is_null($manager->profile->secondary_phone_no))
                                                            <li class="phone"><a href="tel:{{$manager->profile->secondary_phone_no}}">{{$manager->profile->secondary_phone_no}}</a></li>
                                                        @endif
                                                    </ul>

                                                </div>
                                            @endforeach
                                            @foreach($salesTeam->members as $member)
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
                                                        <li class="role">Team Member</li>
                                                        <li class="email"><a href="mailto:{{$member->email}}">{{$member->email}}</a></li>
                                                        <li class="phone"><a href="tel:{{$member->profile->primary_phone_no}}">{{$member->profile->primary_phone_no}}</a></li>
                                                        @if(!is_null($member->profile->secondary_phone_no))
                                                            <li class="phone"><a href="tel:{{$member->profile->secondary_phone_no}}">{{$member->profile->secondary_phone_no}}</a></li>
                                                        @endif
                                                        <li class="action"><button class="btn btn-warning" role="button" onclick="changeManager( {{ $salesTeam->id }}, {{$member->id}} )">Make Manager</button></li>
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

@section('after-footer-script')
    <script type="text/javascript">
        function changeManager(teamid, userid){
            swal({
                    title: "Are you sure?",
                    text: "Manager of this team will be changed",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var request = jQuery.ajax({
                            url: "{{ route("sales-team-change-manager") }}",
                            data: {salesTeamId: teamid, userId: userid},
                            method: "GET",
                            dataType: 'json'
                        });

                        request.done(function (response) {
                            if (response.result == 'Success') {
                                swal('Successful',response.message, 'success', function () {
                                    window.location.reload();
                                });

                                swal({
                                    title: 'Successful',
                                    text: response.message,
                                    type: 'success',
                                }, function () {
                                    window.location.reload();
                                });
                            }
                            else {

                                swal.message('Failed',response.message, 'error');

                            }
                        })

                        request.fail(function (jqXHT, textStatus) {
                            $.notify(textStatus, "error");
                        });

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }
    </script>
@endsection