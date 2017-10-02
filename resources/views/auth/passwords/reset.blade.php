@extends('layouts.no-leftnav-app')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/authentication.css')}}">
@endsection

@section('content')

    <section class="login-section auth-section">
        <div class="container">
            <div class="row">
                <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                    <h1 class="form-box-heading logo text-center">
                        <span class="pe-icon pe-7s-smile icon"></span><span class="highlight">Pvt</span>CRM
                    </h1>

                    <div class="form-box-inner">
                        <h2 class="title text-center">Reset Your Password</h2>

                        <div class="row">
                            <div class="form-container col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group email{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="sr-only" for="login-email">Email or username</label>
                                        <span class="fa fa-user icon"></span>
                                        <input id="login-email"  data-parsley-trigger="change focusout" data-parsley-required-message="You must enter your email" type="email" required name="email" class="form-control login-email " placeholder="Enter Email Address">

                                    @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                    </div>

                                    <div class="form-group password{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="sr-only">Password</label>


                                            <label class="sr-only" for="password">Password</label>
                                            <span class="fa fa-lock icon"></span>
                                            <input id="password" data-parsley-trigger="change focusout" name="password" data-parsley-required-message="You must enter your password" required type="password" class="form-control login-password" placeholder="Enter New Password">

                                               @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>


                                    <div class="form-group password{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="sr-only">Confirm Password</label>
                                        <span class="fa fa-lock icon"></span>
                                            <input type="password" name="password_confirmation" minlength="6" id="userPasswordConfirmation"  class="form-control" placeholder="Enter Password Again" required data-parsley-trigger="change focusout" data-parsley-equalto="#userPassword" data-parsley-equalto-message="Passwords does not match" data-parsley-required-message="You must enter password again.">

                                        @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>


                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Reset Password
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
    </section>
@endsection




@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

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
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
