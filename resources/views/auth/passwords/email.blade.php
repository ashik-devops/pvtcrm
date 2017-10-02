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
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}" data-parsley-validate>
                                    {{ csrf_field() }}

                                    <div class="form-group email {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="sr-only" for="login-email">Email Address</label>
                                        <span class="fa fa-user icon"></span>
                                        <input id="login-email"  data-parsley-trigger="change focusout" data-parsley-required-message="You must enter your email" type="email" required name="email" class="form-control login-email " placeholder="Enter Registered Email">

                                    </div>

                                    <div class="form-group">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Send Password Reset Link
                                            </button>
                                        </div>
                                    </div>
                                </form>                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>


@endsection
