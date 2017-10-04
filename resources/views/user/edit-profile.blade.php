@extends('layouts.app')

@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/intlTelInput.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <h2 class="view-title">Edit Profile</h2>
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
                                        <li role="presentation"><a href="#settings" aria-controls="settings" aria-expanded="true" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-user icon"></span> Settings</a></li>

                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <form class="form-horizontal" method="post" action="{{route('profile-update', [$user->id])}}" enctype="multipart/form-data" data-parsley-validate>
                                    <div class="text-right">
                                        <a class="btn btn-primary" href="{{route('profile-view', $user->id)}}">View Profile</a>
                                        @can('delete', \App\User::class)
                                            <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete User</button>
                                        @endcan
                                    </div>

                                <div class="tab-content">
                                    <div id="profile" role="tabpanel" class="tab-pane active">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH')}}

                                            <fieldset class="fieldset">
                                                <h3 class="fieldset-title">Personal Info</h3>
                                                <div class="form-group avatar">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Upload new profile picture</label>
                                                    <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                                        <input type="file" name="pro_pic" class="file-uploader pull-left form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" data-parsley-trigger="change focusout" data-parsley-required-message="First Name is required" required value="{{old('first_name', $user->first_name)}}">
                                                        @if ($errors->has('first_name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                 </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                                                    <div class="col-md-10 col-sm-9 col-xs-12">
                                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" data-parsley-trigger="change focusout" data-parsley-required-message="Last Name is required" required value="{{old('last_name', $user->last_name)}}">
                                                        @if ($errors->has('last_name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                 </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @can('create', \App\User::class)
                                                    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                                        <label class="col-md-2  col-sm-3 col-xs-12 control-label">Role</label>
                                                        <div class="col-md-10 col-sm-9 col-xs-12">
                                                            <select name="role" id="role" class="form-control" data-parsley-trigger="change" required data-parsley-required-message="You must select a role.">
                                                                @foreach(\App\Role::all() as $role)
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
                                                            <option  @if(old('status', $user->status) == 0) selected @endif  value="0">Inactive</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endcan
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
                                                        <div class="input-container" id="primary_phone_no_error_container">
                                                            <input type="tel" name="primary_phone_no" data-parsley-errors-container="#primary_phone_no_error_container" id="primary_phone_no" class="phone form-control" required data-parsley-trigger="change focusout" value="{{ old('primary_phone_no', $user->profile->primary_phone_no) }}" data-parsley-required-message="You must enter phone no.">
                                                        </div>
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
                                                        <input type="tel" name="secondary_phone_no" id="secondary_phone_no" class="phone form-control"  data-parsley-trigger="change focusout" value="{{ old('secondary_phone_no', $user->profile->secondary_phone_no) }}">
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
                                                            <input id="street_address_1" type="text" placeholder="Steet Address" class="form-control" data-parsley-trigger="change focusout" value="{{ old('street_address_1', !is_null($user->profile->address)?$user->profile->address->street_address_1:'') }}" name="street_address_1" maxlength="128" required data-parsley-required-message="Please enter Address">
                                                            @if ($errors->has('street_address_1'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_address_1') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                        <div style="margin-bottom: 5px;">
                                                            <input id="street_address_2" type="text"  placeholder="Steet Address" class="form-control"  data-parsley-trigger="change focusout" value="{{ old('street_address_2', !is_null($user->profile->address)?$user->profile->address->street_address_2:'') }}" name="street_address_2" maxlength="128" >
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

                                                        <input id="city" type="text" class="form-control" placeholder="City" value="{{ old('city', !is_null($user->profile->address)?$user->profile->address->city:'') }}" name="city" maxlength="32" required data-parsley-trigger="change focusout" required data-parsley-required-message="You must enter city" >
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
                                                            <div id="state-field-container">
                                                            <select required name="state" data-parsley-errors-container="#state-field-container" id="state" class="form-control" style="width: 100%;" data-parsley-trigger="change focusout" required data-parsley-required-message="You must select a state.">

                                                                @if(!is_null(old('state', is_null($user->profile->address)? null: $user->profile->address->state)))
                                                                    <option selected value="{{old('country', $user->profile->address->state)}}">{{$user->profile->address->state}}</option>
                                                                @else
                                                                    <option value="">Select State</option>
                                                                @endif
                                                            </select>
                                                            </div>
                                                            @if ($errors->has('state'))
                                                                <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                                            @endif

                                                    </div>
                                                </div>
                                        {{--

                                        <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                            <label for="country" class="col-md-2 col-sm-3 col-xs-12 control-label">Country</label>
                                            <div class="col-md-10 col-sm-9 col-xs-12">

                                                <input id="country" type="text" class="form-control" placeholder="Country" value="{{ old('country', !is_null($user->profile->address)?$user->profile->address->country:'') }}" name="country" maxlength="32" required required data-parsley-required-message = "You must enter country" data-parsley-trigger="change focusout">
                                                @if ($errors->has('country'))
                                                    <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                                                @endif
                                            </div>
                                        </div>

                                            --}}




                                        <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                            <label for="country" class="col-md-2  col-sm-3 col-xs-12 control-label">Country</label>
                                            <div class="col-md-10 col-sm-9 col-xs-12">
                                                <select required name="country" id="country" class="form-control" style="width: 100%;" data-parsley-trigger="change" required data-parsley-required-message="You must select a country.">
                                                    @if(!is_null(old('country', is_null($user->profile->address)? null: \App\Country::where('code', '=', $user->profile->address->country)->first()->code)))
                                                        <option selected value="{{old('country', \App\Country::where('code', '=', $user->profile->address->country)->first()->code)}}">{{\App\Country::where('code', '=', $user->profile->address->country)->first()->name}}</option>
                                                    @else
                                                        <option selected value="US">{{\App\Country::find(235)->name}}</option>
                                                    @endif

                                                </select>

                                                @if ($errors->has('country'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group"{{ $errors->has('zip') ? ' has-error' : '' }}>
                                            <label for="zip" class="col-md-2 col-sm-3 col-xs-12 control-label">ZIP</label>
                                            <div class="col-md-10 col-sm-9 col-xs-12">

                                                <input id="zip" type="text" class="form-control" placeholder="Zip" value="{{ old('zip', !is_null($user->profile->address)?$user->profile->address->zip:'') }}" name="zip" maxlength="8" required required data-parsley-required-message = "You must enter ZIP Code" data-parsley-trigger="change focusout">
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
                                            <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>
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
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script src="{{asset('storage/assets/js/intlTelInput.min.js')}}"></script>

    <script type="text/javascript">
        jQuery('#status').select2({

        });
        jQuery('#role').select2({
            placeholder: "Select a Role",
        });




       var country = jQuery("#country").select2({
            ajax: {
                url: "{{route('countries')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term

                    };
                },
                processResults : function (data){

                    return {
                        results: data.countries
                    }
                },

                cache: true
            }
        });


       jQuery("#state").select2({
            ajax: {
                placeholder:"Select state",
                url: "{{route('country-states')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {

                    return {
                        country: jQuery("#country").val(),
                        q: params.term, // search term

                    };
                },
                processResults : function (data){

                    return {
                        results: data.states
                    }
                },

                cache: true
            }
        });


        jQuery("#country").on('select2:select', function(){
            $('#state').val('').trigger('change');
            $("#state").parsley().reset();
            $("#state-field-container .parsley-errors-list").remove();
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
        var primary_phone_no = $("#primary_phone_no");
        primary_phone_no.intlTelInput({
            nationalMode: true,
            formatOnDisplay: true,
            utilsScript: "{{asset('storage/assets/js/utils.js')}}"
        });

        primary_phone_no.on("keyup change",function () {
            formatIntlTelephoneNumber(primary_phone_no);
        });

        var secondary_phone_no = $("#secondary_phone_no");
        secondary_phone_no.intlTelInput({
            nationalMode: true,
            formatOnDisplay: true,
            utilsScript: "{{asset('storage/assets/js/utils.js')}}"
        });

        secondary_phone_no.on("keyup change",function () {
            formatIntlTelephoneNumber(secondary_phone_no);
        });

        function formatIntlTelephoneNumber(input) {
            if (typeof intlTelInputUtils !== 'undefined') {

                var intlNumber = input.intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
//                var lastChar = input.val().trim().split('').reverse()[0];

                if (typeof intlNumber === 'string') { // sometimes the currentText is an object :)
                    input.intlTelInput('setNumber', intlNumber); // will autoformat because of formatOnDisplay=true
                }

            }
        }


    </script>

    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection