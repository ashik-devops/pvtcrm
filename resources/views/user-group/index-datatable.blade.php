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
                <button role="button" onclick="createNewUserGroup()" id="new-apt-btn" class="btn btn-success"><i class="fa fa-plus"></i>New Group</button>
            </div>

            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">User Group</h3>--}}

                            </div>

                            <div class="module-content collapse in" id="groups">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="table-responsive">
                                        <table id="user-groups-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Group Name</th>
                                                <th>Users</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>



@endsection

        @section('modal')
            <!-- Modal for creating customer -->
                <div class="modal fade" id="user-group-modal" role="dialog" aria-labelledby="user-group-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-new-user-group-label">Add New User Group</h4>
                            </div>
                            <div class="modal-body">
                                @yield('user-group-create-form')
                            </div>
                        </div>
                    </div>
                </div><!--/modal-->


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

        var datatable = jQuery('#user-groups-table').DataTable({
//                responsive: false,
            select: true,
            processing: true,
            serverSide: true,
            paging:true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            ajax: '{!! route('user-group-index.data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'user_count', name: 'user_count'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        function editUserGroup(id){

            var request =  jQuery.ajax({
                method: "GET",
                url: "{{route('single-user-group.data')}}",
                data: {groupId: id},
                dataType:'json',

            });

            request.done(function(response){
                jQuery("#"+inputMap.userGroupId).val(response.group.id);
                jQuery("#"+inputMap.userGroupName).val(response.group.name);
                jQuery("#user-group-modal #modal-new-user-group-label.modal-title").html("Edit User Group: "+response.group.name);
                jQuery("#user-group-modal #user_group_form_submit").html("Update");
                jQuery("#user-group-modal").modal('show');
                var members = response.group.members.map(function(obj){
                    return obj.id;
                });
                jQuery("#"+inputMap.userIds).val(members).trigger('change');

            });
            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });


        }
        function createNewUserGroup() {
            jQuery("#user-group-modal #modal-new-user-group-label.modal-title").html("Add New User Group");
            jQuery("#user-group-modal #user_group_form_submit").html("Create");

            jQuery("#user-group-modal").modal('show');

        }

        jQuery("#user-group-modal").on('hidden.bs.modal', function(){
            reset_form(jQuery("#userGroupForm")[0])
        });
        function reset_form(el) {
            el.reset();
            jQuery("#"+inputMap.userIds).val('').trigger('change');
            jQuery("#"+inputMap.userGroupId).val('');
        }


        function get_all_user_groups(){
            datatable.ajax.reload(null, false);
        }

        function deleteUserGroup(id){

            swal({
                    title: "Are you sure?",
                    text: "This Group will be deleted!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var request = jQuery.ajax({
                            url: "{{ route('user-group-delete') }}",
                            data: {groupId: id},
                            method: "GET",
                            dataType: "json"
                        });
                        request.done(function (response) {
                            if (response.result == 'Success') {
                                get_all_user_groups();
                                swal.close();
                            }
                            else {
                                swal.message()

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
    </script>

    @yield('group-form-scripts')
@endsection