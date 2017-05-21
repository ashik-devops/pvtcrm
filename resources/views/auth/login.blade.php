@extends('layouts.no-leftnav-app')

@section('after-head-style')
    <link rel="stylesheet" href="assets/css/authentication.css">
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
                        <h2 class="title text-center">Login to Your Account</h2>

                        <div class="row">
                            <div class="form-container col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                                <form class="login-form form-horizontal" role="form" method="POST" action="{{ route('login') }}" data-parsley-validate>
                                    {{ csrf_field() }}
                                    @if(!$errors->isEmpty())
                                        <p class="bg-danger  padding-sm">Invalid Credentials!</p>
                                    @endif
                                    <div class="form-group email {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="sr-only" for="login-email">Email or username</label>
                                        <span class="fa fa-user icon"></span>
                                        <input id="login-email"  data-parsley-trigger="change focusout" data-parsley-required-message="You must enter your email" type="email" required name="email" class="form-control login-email " placeholder="Email or username">

                                    </div>

                                    <div class="form-group password {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="sr-only" for="login-password">Password</label>
                                        <span class="fa fa-lock icon"></span>
                                        <input id="login-password" data-parsley-trigger="change focusout" name="password" data-parsley-required-message="You must enter your password" required type="password" class="form-control login-password" placeholder="Password">


                                        <p class="forgot-password"><a href="reset-password.html">Forgot password?</a></p>
                                    </div>

                                    <button type="submit" class="btn btn-block btn-primary">Login</button>
                                    <div class="checkbox remember">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
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

@section('after-footer-script')
    <script src="assets/js/parsley.js"></script>
@endsection