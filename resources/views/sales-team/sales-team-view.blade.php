@extends('layouts.app')
@include('sales-team.create-form')
@include('task.task-view')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">

    <style type="text/css">
        .datetimepicker{
            z-index: 999 !important;
        }
        .select2-search__field{
            width: auto !important;
        }
    </style>
@endsection
@section('content')

    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <div class="view-title"><h2>Sales Team : {{$salesTeam->name}}</h2></div>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="module">
                        <div class="module-inner">
                            <div class="side-bar">


                                    <div class="user-info">
                                        <ul class="meta list list-unstyled">

                                            <li class="name"><h3>{{$salesTeam->name}}
                                                    <a href="javascript:editSalesTeamName();"><i class="glyphicon glyphicon-edit" style="font-size: 12px;"></i></a>
                                                </h3>

                                            @foreach($salesTeam->managers as $manager)
                                                <li class="name"><h5>{{$manager->name}}</h5>
                                                    @endforeach


                                        </ul>
                                    </div>









                                <nav class="side-menu">
                                    <ul class="nav nav-tabs nav-tabs-theme-2 tablist">
                                        <li><a href="#memebers" role="presentation" aria-controls="members" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-users icon"></span>Members</a></li>
                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <div id="memebers" role="tabpanel" class="tab-pane">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Members</h3>
                                        </div>
                                        <div class="panel-body">


                                            @foreach($salesTeam->managers as $manager)
                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    {{--{{$member->name}}--}}


                                                    <a class="profile-img" href="{{route('profile-view', [$manager->id])}}">
                                                        @if(!is_null($manager->profile->profile_pic) && file_exists('storage/'.$manager->profile->profile_pic))
                                                            <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$manager->profile->profile_pic)}}"/>
                                                        @else
                                                            <img data-name="{{$manager->profile->initial}}" data-char-count="2" class="img-profile profile-avatar img-circle img-responsive center-block" />
                                                        @endif
                                                        {{--<img src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                                    </a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="{{route('profile-view', [$manager->id])}}">{{$manager->name}}</a></li>
                                                        <li class="role">Team Manager</li>
                                                        <li class="email"><a href="mailto:{{$manager->email}}">{{$manager->email}}</a></li>
                                                        <li class="phone"><a href="tel:{{$manager->profile->primary_phone_no}}">{{$manager->profile->primary_phone_no}}</a></li>
                                                        @if(!is_null($manager->profile->secondary_phone_no))
                                                            <li class="phone"><a href="tel:{{$manager->profile->secondary_phone_no}}">{{$manager->profile->secondary_phone_no}}</a></li>
                                                        @endif
                                                    </ul>

                                                </div>
                                            @endforeach
                                            @foreach($salesTeam->members as $member)
                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    {{--{{$member->name}}--}}


                                                    <a class="profile-img" href="{{route('profile-view', [$member->id])}}">
                                                        @if(!is_null($member->profile->profile_pic) && file_exists('storage/'.$member->profile->profile_pic))
                                                            <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$member->profile->profile_pic)}}"/>
                                                        @else
                                                            <img data-name="{{$member->profile->initial}}" data-char-count="2" class="img-profile profile-avatar img-circle img-responsive center-block" />
                                                        @endif
                                                        {{--<img src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                                    </a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="{{route('profile-view', [$member->id])}}">{{$member->name}}</a></li>
                                                        <li class="role">Team Member</li>
                                                        <li class="email"><a href="mailto:{{$member->email}}">{{$member->email}}</a></li>
                                                        <li class="phone"><a href="tel:{{$member->profile->primary_phone_no}}">{{$member->profile->primary_phone_no}}</a></li>
                                                        @if(!is_null($member->profile->secondary_phone_no))
                                                            <li class="phone"><a href="tel:{{$member->profile->secondary_phone_no}}">{{$member->profile->secondary_phone_no}}</a></li>
                                                        @endif
                                                        <li class="action"><button class="btn btn-warning" role="button" onclick="changeManager( {{ $salesTeam->id }}, {{$member->id}} )">Make Manager</button>
                                                       <button class="btn btn-danger" role="button" onclick="removeMember( {{ $salesTeam->id }}, {{$member->id}} )">Remove Member</button></li>
                                                    </ul>

                                                </div>
                                            @endforeach

                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    <button type="button" class="btn btn-default add-button" data-toggle="modal" data-target="#sales-team-member-modal"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button><br>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sales-team-member-modal">Add Member</button></li>
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection



@section('modal')
    <!-- Modal for creating customer -->
    <div class="modal customerModal" id="sales-team-member-modal" role="dialog" aria-labelledby="sales-team-member-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-sales-team-label">Add New Members</h4>
                </div>
                <div class="modal-body">

                    <form method="post" class="ajax-from"  data-parsley-validate id="sales-add-member-form">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
                            <label class="sr-only">User</label>
                            <select name="userIds[]" id="sales-teamMembers" class="form-control select2-selection--multiple" multiple style="width: 100%"  required data-parsley-trigger="change focusout" data-parsley-required-message="Please select at least one member">

                            </select>
                        </div>


                        <div class="form-group margin-top-md center-block text-center">
                            <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" id="sales_team_member_form_submit"  class="btn btn-success">Add</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal customerModal" id="sales-team-name-modal" role="dialog" aria-labelledby="sales-team-name-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-sales-team-label">Edit Name</h4>
                </div>
                <div class="modal-body">

                    <form method="post" class="ajax-from"  data-parsley-validate id="sales-team-edit-name-form">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
                            <label class="sr-only">User</label>
                            <input id="sales-teamName" type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name', $salesTeam->name)}}">
                        </div>


                        <div class="form-group margin-top-md center-block text-center">
                            <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" id="sales_team_member_form_submit"  class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






@endsection








@section('after-footer-script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script type="text/javascript">




        jQuery("#sales-add-member-form").submit(function (e) {
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Member of this team will be changed",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {

                        var data= {
                            '_token': $('input[name="_token"]').val().trim() ,
                            'salesTeamId': '{{$salesTeam->id}}',
                            'userIds': jQuery("#sales-teamMembers").val() }

                        console.log(data);

                        var request = jQuery.ajax({
                            url: "{{ route("sales-team-new-member") }}",
                            data: data,
                            method: "POST",
                            dataType: 'json'
                        });

                        request.done(function (response) {
                            if (response.result == 'Success') {
                                swal('Successful',response.message, 'success', function () {
                                    window.location.reload();
                                });

                                swal({
                                    title: 'Successful',
                                    text: response.message,
                                    type: 'success',
                                }, function () {
                                    window.location.reload();
                                });
                            }
                            else {

                                swal.message('Failed',response.message, 'error');

                            }
                        })

                        request.fail(function (jqXHT, textStatus) {
                            $.notify(textStatus, "error");
                        });

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        })





        jQuery("#sales-team-edit-name-form").submit(function(e){
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Name of this team will be changed",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var request = jQuery.ajax({
                            url: "{{ route("sales-team-name-change") }}",
                            data: {'_token': $('input[name="_token"]').val().trim() ,salesTeamId: '{{$salesTeam->id}}', salesTeamName: jQuery("input#sales-teamName").val().trim() },
                            method: "POST",
                            dataType: 'json'
                        });

                        request.done(function (response) {
                            if (response.result == 'Success') {
                                swal('Successful',response.message, 'success', function () {
                                    window.location.reload();
                                });

                                swal({
                                    title: 'Successful',
                                    text: response.message,
                                    type: 'success',
                                }, function () {
                                    window.location.reload();
                                });
                            }
                            else {

                                swal.message('Failed',response.message, 'error');

                            }
                        })

                        request.fail(function (jqXHT, textStatus) {
                            $.notify(textStatus, "error");
                        });

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        })


        function changeManager(teamid, userid){
            swal({
                    title: "Are you sure?",
                    text: "Manager of this team will be changed",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var request = jQuery.ajax({
                            url: "{{ route("sales-team-change-manager") }}",
                            data: {'_token': $('input[name="_token"]').val().trim(),salesTeamId: teamid, userId: userid},
                            method: "POST",
                            dataType: 'json'
                        });

                        request.done(function (response) {
                            if (response.result == 'Success') {
                                swal('Successful',response.message, 'success', function () {
                                    window.location.reload();
                                });

                                swal({
                                    title: 'Successful',
                                    text: response.message,
                                    type: 'success',
                                }, function () {
                                    window.location.reload();
                                });
                            }
                            else {

                                swal.message('Failed',response.message, 'error');

                            }
                        })

                        request.fail(function (jqXHT, textStatus) {
                            $.notify(textStatus, "error");
                        });

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }









        function removeMember(teamid, userid){
            swal({
                    title: "Are you sure?",
                    text: "Member of this team will be removed",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var request = jQuery.ajax({
                            url: "{{ route("sales-team-remove-member") }}",
                            data: {'_token': $('input[name="_token"]').val().trim(),salesTeamId: teamid, userId: userid},
                            method: "POST",
                            dataType: 'json'
                        });

                        request.done(function (response) {
                            if (response.result == 'Success') {
                                swal('Successful',response.message, 'success', function () {
                                    window.location.reload();
                                });

                                swal({
                                    title: 'Successful',
                                    text: response.message,
                                    type: 'success',
                                }, function () {
                                    window.location.reload();
                                });
                            }
                            else {

                                swal.message('Failed',response.message, 'error');

                            }
                        })

                        request.fail(function (jqXHT, textStatus) {
                            $.notify(textStatus, "error");
                        });

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }


        jQuery("#sales-team-member-modal").on('hidden.bs.modal', function(){
            reset_form(jQuery("#sales-teamForm")[0]);
        });

        function reset_form(el) {
            el.reset();
            member_select.val(null).trigger('change.select2');
            manager_select.val(null).trigger('change.select2');
            jQuery("#"+inputMap.salesTeamId).val('');

        }



        jQuery("#sales-team-member-modal").on('hidden.bs.modal', function(){
            reset_form(jQuery("#sales-add-member-form")[0]);
        });

        function reset_form(el) {
            el.reset();
//            member_select.val(null).trigger('change.select2');
//            manager_select.val(null).trigger('change.select2');
            jQuery("#"+inputMap.salesTeamId).val('');

        }



        function editSalesTeamName(){
            if(jQuery('input#sales-teamName').val().trim().length == 0){
                jQuery('input#sales-teamName').val("{{$salesTeam->name}}").trigger('change');
            }
            jQuery("#sales-team-name-modal").modal('show');

        }

    </script>

    @yield('sales-team-form-scripts')
@endsection