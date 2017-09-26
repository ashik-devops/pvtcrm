@extends('layouts.app')
@include('user.role.form')

@section('after-head-style')
@yield('role_form_styles')
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Create New Role</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module">
                        <div class="module-inner">
                            @yield('role-form')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-footer-script')
    @yield('role_form_scripts')
@endsection