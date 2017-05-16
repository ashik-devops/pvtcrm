@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;">Register a user</div>
                    <div class="panel-body">
                        <div class="col-md-8 col-md-offset-2">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" maxlength="255" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" maxlength="255" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" minlength="6" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" minlength="6" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="initial" class="col-md-4 control-label">Initial</label>

                                    <div class="col-md-6">
                                        <input id="initial" type="text" class="form-control" value="{{ old('initial') }}" name="initial" maxlength="8" required>
                                        @if ($errors->has('initial'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('initial') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="primary_phone" class="col-md-4 control-label">Primary Phone</label>

                                    <div class="col-md-6">
                                        <input id="primary_phone_no" type="text" class="form-control" value="{{ old('primary_phone_no') }}" name="primary_phone_no" maxlength="32" required>
                                        @if ($errors->has('primary_phone_no'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('primary_phone_no') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="secondary_phone" class="col-md-4 control-label">Secondary Phone</label>

                                    <div class="col-md-6">
                                        <input id="secondary_phone" type="text" class="form-control" value="{{ old('secondary_phone_no') }}" name="secondary_phone_no" maxlength="32">
                                        @if ($errors->has('secondary_phone_no'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('secondary_phone_no') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="street_address" class="col-md-4 control-label">Street Address</label>

                                    <div class="col-md-6">
                                        <div style="margin-bottom: 5px;">
                                            <input id="street_address_1" type="text" class="form-control" value="{{ old('street_address_1') }}" name="street_address_1" maxlength="128" required>
                                            @if ($errors->has('street_address_1'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_address_1') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div style="margin-bottom: 5px;">
                                            <input id="street_address_2" type="text" class="form-control" value="{{ old('street_address_2') }}" name="street_address_2" maxlength="128" >
                                            @if ($errors->has('street_address_2'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_address_2') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="city" class="col-md-4 control-label">City</label>

                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control" value="{{ old('city') }}" name="city" maxlength="32" required>
                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="state" class="col-md-4 control-label">State</label>

                                    <div class="col-md-6">
                                        <input id="state" type="text" class="form-control" value="{{ old('state') }}" name="state" maxlength="32" required>
                                        @if ($errors->has('state'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="country" class="col-md-4 control-label">Country</label>

                                    <div class="col-md-6">
                                        <input id="country" type="text" class="form-control" value="{{ old('country') }}" name="country" maxlength="32" required>
                                        @if ($errors->has('country'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <label for="zip" class="col-md-4 control-label">ZIP</label>

                                    <div class="col-md-6">
                                        <input id="zip" type="text" class="form-control" value="{{ old('zip') }}" name="zip" maxlength="8" required>
                                        @if ($errors->has('zip'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group"{{ $errors->has('name') ? ' has-error' : '' }}>
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
