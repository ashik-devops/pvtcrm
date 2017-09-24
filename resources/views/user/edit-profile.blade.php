@extends('layouts.app')

@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <h2 class="view-title">My Account</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module">
                        <div class="module-inner">
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
                                        <li role="presentation"><a href="#settings" aria-controls="settings" aria-expanded="true" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-user icon"></span> Settings</a></li>

                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <form class="form-horizontal" method="post" action="{{route('profile-update', [$user->id])}}" enctype="multipart/form-data" data-parsley-validate>

                                <div class="tab-content">
                                    <div id="profile" role="tabpanel" class="tab-pane active">
                                        <h2 class="title">Profile</h2>
                                            {{csrf_field()}}
                                            {{ method_field('PATCH')}}

                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Personal Info</h3>
                                                <div class="form-group avatar">
                                                    <figure class="figure col-md-2 col-sm-3 col-xs-12">
                                                        <img class="img-rounded img-responsive" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />
                                                    </figure>
                                                    <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                                        <input type="file" name="pro_pic" class="file-uploader pull-left form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Name</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name', $user->name)}}">
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                                 </span>
                                                        @endif
                                                    </div>
                                                </div>



                                                <div class="form-group {{ $errors->has('initial') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Initial</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="text" name="initial" class="form-control" placeholder="Initial" required data-parsley-trigger="change focusout" value="{{ old('initial', $user->profile->initial) }}" data-parsley-required-message="You must enter initial.">
                                                        @if ($errors->has('initial'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('initial') }}</strong>
                                    </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Role</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <select name="role" id="role" class="form-control" data-parsley-trigger="change" required data-parsley-required-message="You must select a role.">
                                                            @foreach($roles as $role)
                                                                <option @if(old('role', $user->role->id) == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('role'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group"{{ $errors->has('status') ? ' has-error' : '' }}>
                                                    <label for="status" class="col-md-2 col-sm-3 col-xs-12 control-label">Status</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <select name="status" class="form-control" id="status" required value="{{old('status',  $user->status)}}">
                                                            <option @if(old('status', $user->status) == 1) selected @endif  value="1">Active</option>
                                                            <option  @if(old('status', $user->role->id) == 0) selected @endif  value="0">Inactive</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Contact Info</h3>
                                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Email</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required data-parsley-trigger="change focusout" value="{{ old('email', $user->email) }}" data-parsley-required-message="You must enter email">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group {{ $errors->has('primary_phone_no') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Primary Phone</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="text" name="primary_phone_no" class="form-control" placeholder="Primary Phone " required data-parsley-trigger="change focusout" value="{{ old('primary_phone_no', $user->profile->primary_phone_no) }}" data-parsley-required-message="You must enter phone no.">
                                                        @if ($errors->has('primary_phone_no'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('primary_phone_no') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group {{ $errors->has('secondary_phone_no') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Secondary Phone</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="text" name="secondary_phone_no" class="form-control" placeholder="Secondary Phone " data-parsley-trigger="change focusout" value="{{ old('secondary_phone_no', $user->profile->secondary_phone_no) }}">
                                                        @if ($errors->has('secondary_phone_no'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('secondary_phone_no') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Address</h3>
                                                <div class="form-group {{ $errors->has('street_address_1') || $errors->has('street_address_2')   ? ' has-error' : '' }}">

                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Steet Address</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <div style="margin-bottom: 5px;">
                                                            <input id="street_address_1" type="text" placeholder="Steet Address" class="form-control" data-parsley-trigger="change focusout" value="{{ old('street_address_1', $user->profile->address_line_1) }}" name="street_address_1" maxlength="128" required data-parsley-required-message="Please enter Address">
                                                            @if ($errors->has('street_address_1'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_address_1') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                        <div style="margin-bottom: 5px;">
                                                            <input id="street_address_2" type="text"  placeholder="Steet Address" class="form-control"  data-parsley-trigger="change focusout" value="{{ old('street_address_2', $user->profile->address_line_2) }}" name="street_address_2" maxlength="128" >
                                                            @if ($errors->has('street_address_2'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_address_2') }}</strong>
                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                                    <label for="city" class="col-md-2 col-sm-3 col-xs-12 control-label">City</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">

                                                        <input id="city" type="text" class="form-control" placeholder="City" value="{{ old('city', $user->profile->city) }}" name="city" maxlength="32" required data-parsley-trigger="change focusout" required data-parsley-required-message="You must enter city" >
                                                        @if ($errors->has('city'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                                    <label for="state" class="col-md-2 col-sm-3 col-xs-12 control-label">State</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">

                                                        <input id="state" type="text" class="form-control" placeholder="State" value="{{ old('state', $user->profile->state) }}" name="state" maxlength="32" required required data-parsley-required-message = "You must enter state" data-parsley-trigger="change focusout">
                                                        @if ($errors->has('state'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                                    <label for="country" class="col-md-2 col-sm-3 col-xs-12 control-label">Country</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">

                                                        <input id="country" type="text" class="form-control" placeholder="Country" value="{{ old('country', $user->profile->country) }}" name="country" maxlength="32" required required data-parsley-required-message = "You must enter country" data-parsley-trigger="change focusout">
                                                        @if ($errors->has('country'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                                    <label for="zip" class="col-md-2 col-sm-3 col-xs-12 control-label">ZIP</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">

                                                        <input id="zip" type="text" class="form-control" placeholder="Zip" value="{{ old('zip', $user->profile->zip) }}" name="zip" maxlength="8" required required data-parsley-required-message = "You must enter ZIP Code" data-parsley-trigger="change focusout">
                                                        @if ($errors->has('zip'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                                        @endif
                                                    </div></div>

                                            </fieldset>
                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Update password</h3>
                                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Password</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="password" name="password" minlength="6" value="unchanged"  class="form-control" id="password" placeholder="Enter Password" required data-parsley-trigger="change focusout" data-parsley-required-message="You must enter a password.">
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Confirm Password</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="password" name="password_confirmation" value="unchanged" minlength="6"  class="form-control" placeholder="Enter Password Again" required data-parsley-trigger="change focusout" data-parsley-equalto="#password" data-parsley-equalto-message="Passwords does not match" data-parsley-required-message="You must enter password again.">
                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <hr>
                                            {{--<div class="form-group">--}}
                                                {{--<div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">--}}
                                                    {{--<input class="btn btn-primary" type="submit" value="Update Profile">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                    </div>

                                    <div id="settings" role="tabpanel" class="tab-pane">
                                        <h2 class="title">Settings</h2>

                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Timezone</h3>
                                                <div class="form-group {{ $errors->has('timezone') ? ' has-error' : '' }}">
                                                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Timezone</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <select required name="timezone" id="timezone" class="form-control" style="width: 100%;" data-parsley-trigger="change" required data-parsley-required-message="You must select a timezone.">
                                                            @if(old('timezone', $user->timezone()->id) > 0 )
                                                            <option selected value="{{old('timezone', $user->timezone()->id)}}">{{\App\Timezone::find(old('timezone', $user->timezone()->id))->getLabel()}}</option>
                                                            @else
                                                                <option selected value="161">{{\App\Timezone::find(161)->getLabel()}}</option>
                                                            @endif

                                                        </select>

                                                        @if ($errors->has('timezone'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </fieldset>
                                            <hr>

                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                            <input class="btn btn-primary" type="submit" value="Update Profile">
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </div>
    </div>

@endsection


@section('after-footer-script')

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


    </script>

    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
@endsection