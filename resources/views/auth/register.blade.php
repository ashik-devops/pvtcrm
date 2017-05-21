@extends('layouts.app')
@include('auth.registration-form')

@section('content')
    <div id="content-wrapper" class="content-wrapper view members-view">
        <div class="container-fluid">
            <div class="projects-heading">
                <h2 class="view-title">Add User</h2>
            </div>
            <div class="row">
                <div class="module-wrapper col-md-12 col-sm-12 col-xs-12">
                    <section class="module members-module module-no-heading">
                        <div class="module-inner">
                            <div class="module-content">
                                @yield('registration-form')
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


@endsection


