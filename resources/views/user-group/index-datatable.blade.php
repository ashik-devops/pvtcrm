@extends('layouts.app')
@include('user-group.create-form')
@include('user-group.user-group-view')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">
@endsection


@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">User Groups</h2>

            <div class="actions">
                <button id="new-apt-btn" class="btn btn-success" data-toggle="modal" data-target="#usergroup-modal"><i class="fa fa-plus"></i>New Group</button>
            </div>
@endsection

        @section('modal')
            <!-- Modal for creating customer -->
                <div class="modal usergroupModal" id="usergroup-modal" role="dialog" aria-labelledby="usergroup-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-new-usergroup-label">Add New User Group</h4>
                            </div>
                            <div class="modal-body">
                                @yield('usergroup-create-form')
                            </div>
                        </div>
                    </div>
                </div><!--/modal-->