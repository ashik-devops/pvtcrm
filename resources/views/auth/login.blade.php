@extends('layouts.no-leftnav-app')
@include('auth.login-form')
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
                                @yield('login-form')
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection


