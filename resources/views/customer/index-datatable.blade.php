@extends('layouts.app')
@include('customer.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datepicker.css')}}">
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
            <h2 class="view-title">Customers</h2>
            <div class="actions">
                <button id="new-customer-btn" class="btn btn-success" data-toggle="modal" data-target="#modal-new-member"><i class="fa fa-plus"></i> New Customer</button>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">Customers</h3>--}}

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
                                                <th>Account #</th>
                                                <th>Name</th>
                                                <th>Account Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Priority</th>
                                                <th>Assigned To</th>
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
    <!-- Modal for creating customer -->
    <div class="modal customerModal" id="modal-new-member" role="dialog" aria-labelledby="modal-new-member">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-customer-label">Add New Customer</h4>
                </div>
                <div class="modal-body">
                    @yield('customer-create-form')
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
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script type="text/javascript">

        var inputMap = {
            customerId : 'customerId',
            userId : 'userId',
            firstName : 'firstName',
            lastName : 'lastName',
            customerTitle : 'customerTitle',
            customerEmail : 'customerEmail',
            customerPhone : 'customerPhone',
            customerPriority : 'customerPriority',

            accountId : 'accountId',
            accountNo : 'accountNo',
            addressId : 'addressId',
            accountName : 'accountName',
            accountEmail : 'customerEmail',
            accountPhone : 'customerPhone',
            accountWebsite : 'accountWebsite',
            streetAddress_1 : 'streetAddress_1',
            streetAddress_2 : 'streetAddress_2',
            city : 'city_id',
            state : 'state_id',
            country : 'country_id',
            zip : 'zip_id',
        };

        var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
            dom: 'Bfrtip',
            select: true,
            processing: true,
            serverSide: true,
            paging:true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            ajax: '{!! route('customers-data') !!}',
            columns: [
                { data: 'id', name: 'id', searchable: false, visible:false },
                { data: 'account_no', name: 'account_no', searchable: true},
                { data: 'name', name: 'name', searchable: false},
                { data: 'account_name', name: 'account_name', searchable: true},
                { data: 'email', name: 'email' },
                { data: 'phone_no', name: 'phone_no' },
                { data: 'priority', name: 'priority' },
                { data: 'user_name', name: 'user_name', searchable: true},
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

        //bulk action

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





        //creating customer, editing customer and deleting customer


        jQuery("#new-customer-btn").click(function (){
            reset_form(jQuery("#customerForm")[0]);
            jQuery(".customerModal .modal-title").html('Add New Customer');
            jQuery("#accountId").html('');
        });
        var account_select=jQuery("#accountId").select2({
            placeholder: "Select a Account",
            allowClear:true,
            ajax: {
                url: "{{route('list-accounts')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults : function (data){
                    if(data.total_count < 1){
                        return {results: [{
                            id: -1,
                            text: "Create New"
                        }]};

                    }

                    return {
                        results: JSON.parse(JSON.stringify(data.items).replace(new RegExp("\"name\":", 'g'), "\"text\":"))
                    }
                },

                cache: true
            }
        });
        account_select.on("select2:select", function (e) {
            var selection = e.params.data;
            console.log(selection);
            if(selection.id < 1){
                //creating customer with account
                $('#AccountDataAtCustomerForm').show();
                $("#AccountDataAtCustomerForm input").val('');

            }
            else if(selection.id > 1){
                $('#AccountDataAtCustomerForm').hide();
                //now a selection is made populate data of selected account

            }


//
        });
        var priority= jQuery("#customerPriority").select2({});

        var user_select=jQuery("#userId").select2({
            placeholder: "Assign User",
            ajax: {
                url: "{{route('list-users')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults : function (data){

                    return {
                        results: JSON.parse(JSON.stringify(data.items).replace(new RegExp("\"name\":", 'g'), "\"text\":"))
                    }
                },
                cache: true
            }
        });


        $('#hiddenForEditCustomer').show();
        $('#AccountDataAtCustomerForm').hide();


        $('#customerForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();

            var customer = {
                customerId : $('#'+inputMap.customerId).val(),
                userId : $('#'+inputMap.userId).val(),
                firstName : $('#'+inputMap.firstName).val(),
                lastName : $('#'+inputMap.lastName).val(),
                customerTitle : $('#'+inputMap.customerTitle).val(),
                customerEmail : $('#'+inputMap.customerEmail).val(),
                customerPhone : $('#'+inputMap.customerPhone).val(),
                customerPriority : $('#'+inputMap.customerPriority).val(),
            };

            var account = {
                accountId : $('#'+inputMap.accountId).val(),
                accountNo : $('#'+inputMap.accountNo).val(),
                addressId : $('#'+inputMap.addressId).val(),
                accountName : $('#'+inputMap.accountName).val(),
                accountEmail : $('#'+inputMap.customerEmail).val(),
                accountPhone : $('#'+inputMap.customerPhone).val(),
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
                account: account,
                customer:customer
            };



            if(customer.customerId < 1){
                //customer creating.....


                var request = jQuery.ajax({
                    url: "{{ route('create.customer') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {

                    if(response.result){
                        if(response.result == 'Saved') {
                            reset_form($('#customerForm')[0]);
                            jQuery("#accountId").html("");
                            $('#modal-new-member').modal('hide');
                            get_all_customer_data();
                            $.notify(response.message, "success");

                        }
                        else{
                            jQuery.notify(response.message, "error");

                        }
                    }

                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");

                });

            }else{
                //updating customer.....

                var request = jQuery.ajax({
                    url: "{{ route('update.customer.data') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#customerForm')[0]);
                        jQuery("#accountId").html("");
                        $('#customerId').val('');
                        $('#modal-new-member').modal('hide');
                        get_all_customer_data();
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


        function handle_error(xhr) {
            if(xhr.status==422){
                showParselyError();
            }
        }
        function showParselyError(field, msg){
            var el = jQuery("#"+inputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }

        function reset_form(el) {
            el.reset();
            jQuery("#"+inputMap.addressId).val('');
            jQuery("#"+inputMap.customerId).val('');
            jQuery("#"+inputMap.accountId).val('0');
        }
        // For editing Customer


        function editCustomer(id){


            $.get("{{ route('get.customer.data') }}", { id: id} ,function(data){

                jQuery(".customerModal .modal-title").html('Edit Customer');

                if(data){

                    $('#modal_button').val('Update Customer');
                    $('#customerId').val(data.customer.id);
                    $('#firstName').val(data.customer.first_name);
                    $('#lastName').val(data.customer.last_name);
                    $('#customerTitle').val(data.customer.title);
                    $('#customerEmail').val(data.customer.email);
                    $('#customerPhone').val(data.customer.phone_no);
                    $('#customerPriority').val(data.customer.priority);
                    jQuery("#userId").html("<option selected value='"+data.user.id+"'>"+data.user.name+"</option>")

                    if(data.account){
                        jQuery("#accountId").html("<option selected value='"+data.account.id+"'>"+data.account.name+"</option>")
                        $('#accountName').val(data.account.name);
                        $('#accountEmail').val(data.account.email);
                        $('#accountPhone').val(data.account.phone_no);
                        $('#accountWebsite').val(data.account.website);

                        if(data.address[0]){
                            $('#addressId').val(data.address[0].id);
                            $('#streetAddress_1').val(data.address[0].street_address_1);
                            $('#streetAddress_2').val(data.address[0].street_address_2);
                            $('#city_id').val(data.address[0].city);
                            $('#state_id').val(data.address[0].state);
                            $('#country_id').val(data.address[0].country);
                            $('#zip_id').val(data.address[0].zip);

                        }
                        $('#hiddenForEditCustomer').hide();
                        $('#AccountDataAtCustomerForm').hide();
                    }





                    /* $('#account_id').val(data.account.id);
                     $('#accountName').val(data.account.name);
                     $('#accountEmail').val(data.account.email);
                     $('#accountPhone').val(data.account.phone_no);
                     $('#accountWebsite').val(data.account.website);

                     if(data.account_address.length > 0){
                     $('#streetAddress_1').val(data.account_address[0].street_address_1);
                     $('#streetAddress_2').val(data.account_address[0].street_address_2);
                     $('#city_id').val(data.account_address[0].city);
                     $('#state_id').val(data.account_address[0].state);
                     $('#country_id').val(data.account_address[0].country);
                     $('#zip_id').val(data.account_address[0].zip);
                     } */
                }
            });


            $('#modal-new-member').modal('show');

        }


        function deleteCustomer(id){
            console.log(id);
            var _token = $('input[name="_token"]').val();
            var data = {
                _token : _token,
                id: id
            };
            swal({
                    title: "Are you sure?",
                    text: "This Information will be deleted!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {

                        //deletion process is going on....


                        $.post("{{ route('delete.customer.data') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Customer(s) has been deleted.", "success");
                                get_all_customer_data();
                                $.notify(result, "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete customer(s)", "error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Customer is safe :)", "error");
                    }
                });
        }

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


                        $.post("{{ route('bulk.delete.customer.data') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Account has been deleted.", "success");
                                get_all_customer_data();
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


        function get_all_customer_data(){

            datatable.ajax.reload(null, false);
        }


    </script>
@endsection