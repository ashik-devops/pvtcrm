@extends('layouts.app')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <h2 class="view-title">View Profile</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module">
                        <div class="module-inner">
                            @includeWhen(\Illuminate\Support\Facades\Session::has('message'), 'common.alert')

                            <div class="side-bar">
                                <div class="user-info">
                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />
                                    <ul class="meta list list-unstyled">
                                        <li class="name">{{$user->name}}
                                            <label class="label label-info">{{$user->role->name}}</label>
                                        </li>
                                        <li class="email"><a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                                        <li class="activity">Last logged in: Today at 2:18pm</li>
                                    </ul>
                                </div>

                                <nav class="side-menu">
                                    <ul class="nav nav-tabs nav-tabs-theme-2 tablist">
                                        <li class="active" role="presentation"><a href="#profile" aria-controls="profile" aria-expanded="true" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-user icon"></span> Profile</a></li>

                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <form class="form-horizontal" method="post" action="{{route('profile-update', [$user->id])}}" enctype="multipart/form-data" data-parsley-validate>

                                <div class="tab-content">
                                    <div class="text-right">
                                        <a class="btn btn-primary" href="{{route('profile-edit', $user->id)}}">Edit Profile</a>
                                        @can('delete', \App\User::class)
                                            <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete User</button>
                                        @endcan
                                    </div>

                                    <div id="profile" role="tabpanel" class="tab-pane active">

                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Personal Info</h3>
                                                <div class="row">
                                                    <label class="col-sm-3 col-xs-4 col-md-2 text-right">Name</label>
                                                    <div class="col-sm-9 col-xs-8 col-md-10">{{$user->name}}</div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-3 col-xs-4 col-md-2 text-right">Initials</label>
                                                    <div class="col-sm-9 col-xs-8 col-md-10">{{$user->profile->initial}}</div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-3 col-xs-4 col-md-2 text-right">Role</label>
                                                    <div class="col-sm-9 col-x8-6 col-md-10">{{$user->role->name}}</div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-3 col-xs-4 col-md-2 text-right">Status</label>
                                                    <div class="col-sm-9 col-x8-6 col-md-10">{{$user->status==1?'Active':'Inactive'}}</div>
                                                </div>

                                            </fieldset>
                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Contact Info</h3>
                                                    <div class="row">
                                                        <label class="col-md-2 col-sm-3 col-xs-4 text-right">Email</label>
                                                        <div class="col-md-10 col-sm-9 col-xs-8"><a href="mailto:{{$user->email}}">{{$user->email}}</a></div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-2 col-sm-3 col-xs-4 text-right">Primary Phone No</label>
                                                        <div class="col-md-10 col-sm-9 col-xs-8"><a href="tel:{{$user->profile->primary_phone_no}}">{{$user->profile->primary_phone_no}}</a></div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-2 col-sm-3 col-xs-4 text-right">Secondary Phone No</label>
                                                        <div class="col-md-10 col-sm-9 col-xs-8"><a href="tel:{{$user->profile->secondary_phone_no}}">{{$user->profile->secondary_phone_no}}</a></div>
                                                    </div>
                                            </fieldset>

                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Address</h3>
                                                <div class="row">

                                                    <label class="col-md-2 col-sm-3 col-xs-4 text-right">Address</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-8">
                                                        @includeWhen(@isset($user->profile->address),'common.address-block', ['address'=>$user->profile->address])

                                                    </div>
                                                </div>
                                            </fieldset>

                                            </fieldset>

                                            <hr>
                                            {{--<div class="form-group">--}}
                                                {{--<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">--}}
                                                    {{--<input class="btn btn-primary" type="submit" value="Update Profile">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                    </div>

                                    {{--<div id="settings" role="tabpanel" class="tab-pane">--}}
                                        {{--<h2 class="title">Settings</h2>--}}

                                            {{--<fieldset class="fieldset">--}}
                                                {{--<h3 class="fieldset-title">Timezone</h3>--}}
                                                {{--<div class="form-group {{ $errors->has('timezone') ? ' has-error' : '' }}">--}}
                                                    {{--<label class="col-md-2  col-sm-3 col-xs-12 control-label">Timezone</label>--}}
                                                    {{--<div class="col-md-10 col-sm-9 col-xs-12">--}}
                                                        {{--<select required name="timezone" id="timezone" class="form-control" style="width: 100%;" data-parsley-trigger="change" required data-parsley-required-message="You must select a timezone.">--}}
                                                            {{--@if(old('timezone', $user->timezone()->id) > 0 )--}}
                                                            {{--<option selected value="{{old('timezone', $user->timezone()->id)}}">{{\App\Timezone::find(old('timezone', $user->timezone()->id))->getLabel()}}</option>--}}
                                                            {{--@else--}}
                                                                {{--<option selected value="161">{{\App\Timezone::find(161)->getLabel()}}</option>--}}
                                                            {{--@endif--}}

                                                        {{--</select>--}}

                                                        {{--@if ($errors->has('timezone'))--}}
                                                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('role') }}</strong>--}}
                                    {{--</span>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                            {{--</fieldset>--}}
                                            {{--<hr>--}}

                                    {{--</div>--}}
                                </div>


                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </div>
    </div>

@endsection


@section('after-footer-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>

    <script type="text/javascript">
        jQuery('#status').select2({

        });
        jQuery('#role').select2({
            placeholder: "Select a Role",
        });

       var timezone = jQuery("#timezone").select2({
            ajax: {
                url: "{{route('timezones')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term

                    };
                },
                processResults : function (data){

                    return {
                        results: data.timezones
                    }
                },

                cache: true
            }
        });

        function deleteUser() {
            swal({
                    title: "Are you sure?",
                    text: "This Information will be deleted!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                         window.location.href = "{{route('user-delete', $user->id)}}";

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }
    </script>


@endsection