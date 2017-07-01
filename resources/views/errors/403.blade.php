@extends('layouts.no-leftnav-app')

@section('content')
    <section class="login-section auth-section">
        <div class="container">
            <div class="row">
                <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                    <h1 class="form-box-heading logo text-center">
                        <span class="pe-icon pe-7s-box2 icon"></span><span class="highlight">Pvt</span>CRM
                    </h1>

                    <div class="jumbotron text-center error-401">
                        <h1>403</h1>
                        <p class="margin-bottom-lg">Forbidden! Looks is not correct place for you to look into.</p>
                        <div class="action"><a class="btn btn-primary btn-lg" href="{{route('dashboard')}}" role="button">Back to Home</a></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/authentication.css')}}">
@endsection