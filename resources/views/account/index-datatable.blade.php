@extends('layouts.app')
@include('account.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <style type="text/css">
        #bulk_action_container{
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Customer Companies</h2>
            <div class="actions">
                <button class="btn btn-success" id="new-account" data-toggle="modal" data-target="#modal-new-account"><i class="fa fa-plus"></i> New account</button>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">Customer Companies</h3>--}}

                            </div>

                            <div class="module-content collapse in" id="customers">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="row" id="bulk_action_container">
                                        <div class="col-xs-12 col-md-12">
                                            <select id="bulk_action" style="min-width: 200px;">
                                                <option value="" selected>Bulk Action</option>
                                                <option value="Delete">Delete</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <table id="customers-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Account No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Website</th>
                                                <th>Actions</th>
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
    <!-- Modal for Editing account -->
    <div class="modal" id="modal-new-account" tabindex="-1" role="dialog" aria-labelledby="modal-new-account">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="new_edit_account">
                        <h4 class="modal-title" id="modal-new-ticket-label new_edit_user">Create New Account</h4>
                    </div>

                </div>
                <div class="modal-body">
                    @yield('account-create-from')
                </div>
            </div>
        </div>
    </div><!--/modal-->
    <!-- Modal for creating customer -->
    <div class="modal customerModal" id="task-exitmodal" role="dialog" aria-labelledby="task-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-task-label">Add New Task</h4>
                </div>
                <div class="modal-body">
                    @yield('task-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
    <div class="modal customerModal" id="task-modal-view" role="dialog" aria-labelledby="task-modal-view">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-view-task-label"> Task View</h4>
                </div>
                <div class="modal-body">
                    @yield('task-view')
                </div>
            </div>
        </div>
    </div><!--/modal-->
    <div class="modal customerModal" id="task-modal-complete" role="dialog" aria-labelledby="task-modal-complete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-complete-task-label"> Complete Task</h4>
                </div>
                <div class="modal-body">
                    @yield('journal-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
    <div class="modal appointmentModal" id="appointment-modal" role="dialog" aria-labelledby="appointment-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-appointment-label">Add New Appointment</h4>
                </div>
                <div class="modal-body">
                    @yield('appointment-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
    <div class="modal customerModal" id="appointment-modal-view" role="dialog" aria-labelledby="appointment-modal-view">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-view-appointment-label"> Appointment View</h4>
                </div>
                <div class="modal-body">
                    @yield('appointment-view')
                </div>
            </div>
        </div>
    </div>

    <div class="modal customerModal" id="journal-modal" role="dialog" aria-labelledby="journal-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-journal-label">Add New Journal</h4>
                </div>
                <div class="modal-body">
                    @yield('journal-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
@endsection


@section('after-footer-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    {{--Build the datatables--}}
    <script type="text/javascript">
        var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
            dom: '<\'row\'<\'col-sm-6\'l><\'col-sm-6\'f>>Brtip',
            select: true,
            processing: true,
            serverSide: true,
            paging:true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            ajax: '{!! route('account-data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'account_no', name: 'account_no' },
                { data: 'name', name: 'name',searchable: true},
                { data: 'email', name: 'email' },
                { data: 'phone_no', name: 'phone_no' },
                { data: 'website', name: 'website' },
                { data: 'action', name: 'action', orderable: false, searchable: false},

            ],
            buttons: [
                {
                    text: 'Reload',
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload(null, false);
                    }
                },
                {
                    text: 'Select Visible',
                    action: function () {
                        datatable.rows().select();
                    }
                },
                {
                    text: 'Select none',
                    action: function () {
                        datatable.rows().deselect();
                    }
                }
            ]
        });

        var bulk_action=jQuery("#bulk_action").select2();

        bulk_action.on('select2:select', function (e) {
            var action = e.params.data.id;
            if(action != ''){
                var selected_rows = datatable.rows( { selected: true }).data();

                switch (action){
                    case "Delete": deleteRows(selected_rows);
                        break;
                }
            }


        });

        function deleteRows(rows){
            var _token = $('input[name="_token"]').val();
            var data = {
                _token : _token,
                ids: rows.map(function(item){
                    return item.id;
                }).join(',')
            };
            swal({
                    title: "Are you sure?",
                    text: "Item(s) will be deleted!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {

                        //deletion process is going on....


                        $.post("{{ route('bulk.delete.account.data') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "account(s) has been deleted.", "success");
                                get_all_account_data();
                                $.notify(result, "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete", "error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Cancelled)", "error");
                    }
                });
        }
        var inputMap= {
            accountId : 'account_id',
            accountNo : 'accountNo',
            addressId : 'address_id',
            accountName : 'accountName',
            accountEmail : 'accountEmail',
            accountPhone : 'accountPhone',
            accountWebsite : 'accountWebsite',
            streetAddress_1 : 'streetAddress_1',
            streetAddress_2 : 'streetAddress_2',
            city : 'city_id',
            state : 'state_id',
            country : 'country_id',
            zip: 'zip_id'
        };
        jQuery("button#new-account").click(function (){
            $('#new_edit_account .modal-title').html('Create New account');
        });
        //For creating account....
        $('#accountForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();

            var account = {
                accountId : $('#'+inputMap.accountId).val(),
                accountNo : $('#'+inputMap.accountNo).val(),
                addressId : $('#'+inputMap.addressId).val(),
                accountName : $('#'+inputMap.accountName).val(),
                accountEmail : $('#'+inputMap.accountEmail).val(),
                accountPhone : $('#'+inputMap.accountPhone).val(),
                accountWebsite : $('#'+inputMap.accountWebsite).val(),
                streetAddress_1 : $('#'+inputMap.streetAddress_1).val(),
                streetAddress_2 : $('#'+inputMap.streetAddress_2).val(),
                city : $('#'+inputMap.city).val(),
                state : $('#'+inputMap.state).val(),
                country : $('#'+inputMap.country).val(),
                zip : $('#'+inputMap.zip).val()
            };

            var data = {
                _token : _token,
                account: account
            };

            if(account.accountId === ''){
                //account creating.....


                var request = jQuery.ajax({
                    url: "{{ route('create.account') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#accountForm')[0]);
                        $('#modal-new-account').modal('hide');
                        get_all_account_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }else{
                //account editing.....

                var request = jQuery.ajax({
                    url: "{{ route('update.account') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#accountForm')[0]);

                        $('#modal-new-account').modal('hide');
                        get_all_account_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });

            }
        });

        function reset_form(el) {
            el.reset();
            $('#account_id').val('');
        }

        function editAccount( id){

            $('#new_edit_account .modal-title').html('Edit account');

            $.get("{{ route('edit.modal.data') }}", { id: id} ,function(data){
                if(data){
                    $('#modal_button').val('Update account');
                    $('#account_id').val(data.account.id);
                    $('#accountNo').val(data.account.account_no);
                    $('#accountName').val(data.account.name);
                    $('#accountEmail').val(data.account.email);
                    $('#accountPhone').val(data.account.phone_no);
                    $('#accountWebsite').val(data.account.website);

                    if(data.account_address.length > 0){
                        $('#address_id').val(data.account_address[0].id);
                        $('#streetAddress_1').val(data.account_address[0].street_address_1);
                        $('#streetAddress_2').val(data.account_address[0].street_address_2);
                        $('#city_id').val(data.account_address[0].city);
                        $('#state_id').val(data.account_address[0].state);
                        $('#country_id').val(data.account_address[0].country);
                        $('#zip_id').val(data.account_address[0].zip);
                    }
                }
            });
            $('#modal-new-account').modal('show');
        }


        function get_all_account_data(){
            datatable.ajax.reload(null, false);
        }


    </script>
@endsection