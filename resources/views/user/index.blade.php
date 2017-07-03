@extends('layouts.app')
@include('auth.registration-form')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/members.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view members-view">
        <div class="container-fluid">
            <div class="projects-heading">
                <h2 class="view-title">Members</h2>
                <div class="actions">
                    <button class="btn btn-success" data-toggle="modal" data-target="#user-modal"><i class="fa fa-plus"></i> New User</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="module-wrapper col-md-12 col-sm-12 col-xs-12">
                    <section class="module members-module module-no-heading">
                        <div class="module-inner">
                            <div class="module-content">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="members-list">
                                        @foreach ($users->items() as $user)
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="{{route('profile-edit', [$user->id])}}"><img src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="{{route('profile-edit', [$user->id])}}">{{$user->name}}</a></li>
                                                        <li class="role">{{$user->role->name or "Not Set"}}</li>
                                                        <li class="email"><a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                                                        <li class="phone"><a href="tel:{{$user->profile->primary_phone_no}}">{{$user->profile->primary_phone_no}}</a></li>
                                                        @if(!is_null($user->profile->secondary_phone_no))
                                                            <li class="phone"><a href="tel:{{$user->profile->secondary_phone_no}}">{{$user->profile->secondary_phone_no}}</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        {{--<li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>--}}
                                                        <li class="call"><a href="tel:{{$user->profile->primary_phone_no_no}}"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="mailto:{{$user->email}}"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        {{--<li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>--}}
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">5</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">231</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">0</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        {{$users->links()}}
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


@section('modal')
    <!-- Modal (New Member) -->
    <div class="modal" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="modal-new-member">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-ticket-label">Add New User</h4>
                </div>
                <div class="modal-body">
                    @yield('registration-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
@endsection

@section('after-footer-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script>
        $('#userForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            //console.log('hello');
            var user = {

                userName : $('#userName').val(),
                userEmail : $('#userEmail').val(),
                userInitial : $('#userInitial').val(),
                userRole : $('#userRole').val(),
                userPassword : $('#userPassword').val(),
                userPrimaryPhone : $('#userPrimaryPhone').val(),
                userSecondaryPhone : $('#userSecondaryPhone').val(),
                userStreetAddress_1 : $('#userStreetAddress_1').val(),
                userStreetAddress_2 : $('#userStreetAddress_2').val(),
                userCity : $('#userCity').val(),
                userState : $('#userState').val(),
                userCountry : $('#userCountry').val(),
                userZip : $('#userZip').val(),
                userStatus : $('#userStatus').val(),


            };
            var data = {
                _token : _token,
                user: user
            };

            var request = jQuery.ajax({
                url: "{{ route('create-user') }}",
                data: data,
                method: "POST",
                dataType: "json"
            });
            request.done(function (response) {

                if(response.result == 'Saved'){
                    $('#userForm')[0].reset();
                    $('#user-modal').modal('hide');
                    //get_all_task_data();
                    $.notify(response.message, "success");
                }
                else{
                    jQuery.notify(response.message, "error");
                }
            })

            request.fail(function (jqXHT, textStatus) {
                $.notify(textStatus, "error");
            });

        });


    </script>
@endsection