echo "hello";
@extends('layouts.app')
@include('user-group.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
@endsection
@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <div class="view-title"><h2>User Group : {{$userGroup->name}}
                       </h2></div>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="module">
                        <div class="module-inner">
                            <div class="side-bar">

                                <div class="user-info">
                                    {{--                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                    <ul class="meta list list-unstyled">
                                        <li class="name"><h3>{{$userGroup->name}}
                                                <a href="javascript:editUserGroupName();"><i class="glyphicon glyphicon-edit" style="font-size: 12px;"></i></a>

                                            </h3>


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
                                            @foreach($userGroup->members as $member)
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
                                                    <li class="role">{{$member->role->name or "Not Set"}}</li>
                                                    <li class="email"><a href="mailto:{{$member->email}}">{{$member->email}}</a></li>
                                                    <li class="phone"><a href="tel:{{$member->profile->primary_phone_no}}">{{$member->profile->primary_phone_no}}</a></li>
                                                    @if(!is_null($member->profile->secondary_phone_no))
                                                        <li class="phone"><a href="tel:{{$member->profile->secondary_phone_no}}">{{$member->profile->secondary_phone_no}}</a></li>
                                                    @endif
                                                    <li class="action"><button class="btn btn-danger" role="button" onclick="removeUser( {{ $userGroup->id }}, {{$member->id}} )">Remove User</button></li>
                                                </ul>

                                            </div>
                                            @endforeach

                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    <button type="button" class="btn btn-default add-button" data-toggle="modal" data-target="#user-group-member-modal"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button><br>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#user-group-member-modal">Add Member</button></li>
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

    <div class="modal customerModal" id="user-group-member-modal" role="dialog" aria-labelledby="user-group-member-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-sales-team-label">Add New Members</h4>
                </div>
                <div class="modal-body">

                    <form method="post" class="ajax-from"  data-parsley-validate id="user-group-member-form">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
                            <label class="sr-only">User</label>
                            <select name="userIds[]" id="userGroupMembers" class="form-control select2-selection--multiple" multiple style="width: 100%"  required data-parsley-trigger="change focusout" data-parsley-required-message="Please select at least one member">
                            </select>

                        </div>


                        <div class="form-group margin-top-md center-block text-center">
                            <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" id="user_group_member_form_submit"  class="btn btn-success">Add</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>





    <div class="modal customerModal" id="user-group-name-modal" role="dialog" aria-labelledby="user-group-name-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-sales-team-label">Edit Name</h4>
                </div>
                <div class="modal-body">

                    <form method="post" class="ajax-from"  data-parsley-validate id="user-group-edit-name-form">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
                            <label class="sr-only">User</label>
                            <input id="userGroupName" type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name', $userGroup->name)}}">
                        </div>


                        <div class="form-group margin-top-md center-block text-center">
                            <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" id="user_group_name_form_submit"  class="btn btn-success">Save</button>
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





        var user_select=jQuery("#userGroupMembers").select2({
            placeholder: "Choose Members",
            ajax: {
                url: "{{route('user-group-member-options', ['team'=>$userGroup->id])}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults : function (data){

                    return {
                        results: data.users
                    }
                },
                cache: true
            }
        });



        jQuery("#user-group-member-form").submit(function (e) {
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Member of this group will be changed",
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
                            'userGroupId': '{{$userGroup->id}}',
                            'userIds': jQuery("#userGroupMembers").val() }

                        console.log(data);

                        var request = jQuery.ajax({
                            url: "{{ route("user-group-new-member") }}",
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





        jQuery("#user-group-edit-name-form").submit(function(e){
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Name of this group will be changed",
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
                            url: "{{ route("user-group-name-change") }}",
                            data: {'_token': $('input[name="_token"]').val().trim() ,userGroupId: '{{$userGroup->id}}', userGroupName: jQuery("input#userGroupName").val().trim() },
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






        function removeUser(groupid, userid){
            swal({
                    title: "Are you sure?",
                    text: "Member of this group will be removed",
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
                            url: "{{ route("user-group-remove-user") }}",
                            data: {'_token': $('input[name="_token"]').val().trim(), groupId: groupid, userId: userid},
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




        function editUserGroupName(){
            if(jQuery('input#userGroupName').val().trim().length == 0){
                jQuery('input#userGroupName').val("{{$userGroup->name}}").trigger('change');
            }

            jQuery("#user-group-name-modal").modal('show');
        }





    </script>

    @yield('group-form-scripts')
@endsection