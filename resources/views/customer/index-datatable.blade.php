@extends('layouts.app')
@include('customer.create-form');
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Customers</h2>
            <div class="actions">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-new-member"><i class="fa fa-plus"></i> New Customer</button>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                <h3 class="module-title">Customers</h3>
                                <ul class="actions list-inline">
                                    <li><a class="collapse-module" data-toggle="collapse" href="#content-1" aria-expanded="false" aria-controls="content-1"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>
                                    <li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>
                                </ul>

                            </div>

                            <div class="module-content collapse in" id="customers">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="table-responsive">
                                        <table id="customers-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Actions</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
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
    <div class="modal customerModel" id="modal-new-member" tabindex="-1" role="dialog" aria-labelledby="modal-new-member">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-ticket-label">Add New Customer</h4>
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
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script type="text/javascript">
        jQuery('document').ready(function() {
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('customers-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name', searchable: false},
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone_no' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},
                    { data: 'first_name', name: 'first_name', searchable: true, visible:false},
                    { data: 'last_name', name: 'last_name', searchable: true, visible:false},
                ]
            });

        });
    </script>
@endsection
@section('customer-create-edit-delete-scripts')')
    <script>
        //creating customer, editing customer and deleting customer

        $(document).ready(function(){

            $('#hiddenForEditCustomer').show();
            $('#CompanyDataAtCustomerForm').hide();


            $('#customerForm').on('submit',function(e){
                e.preventDefault();
                var _token = $('input[name="_token"]').val();

                var customer = {
                    customerId : $('#customerId').val(),
                    firstName : $('#firstName').val(),
                    lastName : $('#lastName').val(),
                    customerTitle : $('#customerTitle').val(),
                    customerEmail : $('#customerEmail').val(),
                    customerPhone : $('#customerPhone').val(),
                };

                var company = {
                    companyId : $('#companyId').val(),
                    addressId : $('#addressId').val(),
                    companyName : $('#companyName').val(),
                    companyEmail : $('#customerEmail').val(),
                    companyPhone : $('#customerPhone').val(),
                    companyWebsite : $('#companyWebsite').val(),
                    streetAddress_1 : $('#streetAddress_1').val(),
                    streetAddress_2 : $('#streetAddress_2').val(),
                    city : $('#city_id').val(),
                    state : $('#state_id').val(),
                    country : $('#country_id').val(),
                    zip : $('#zip_id').val()
                };


                var data = {
                    _token : _token,
                    company: company,
                    customer:customer
                };



                if(customer.customerId === ''){
                    //customer creating.....
                    $.post("{{ route('create.customer') }}", data, function(result){
                        $('#customerForm')[0].reset();
                        $('#modal-new-member').modal('hide');
                        get_all_customer_data();
                        $.notify(result, "success");

                    });
                }else{
                    //updating customer.....
                    $.post("{{ route('update.customer.data') }}", data, function(result){

                        console.log(result);
                        $('#customerForm')[0].reset();
                        $('#customerId').val('');
                        $('#new_edit_user').text('Add New User');
                        $('#modal-new-member').modal('hide');
                        get_all_customer_data();
                        $.notify(result, "success");
                        $('#modal_button').val('Add Customer');
                        $('#new_edit_user').html('<h4 class="modal-title" id="modal-new-ticket-label new_edit_user">Add New Customer</h4>');

                    });
                }
            });

        });

        // For editing Customer


        function editCustomer(id){


            $.get("{{ route('edit.customer.data') }}", { id: id} ,function(data){



                if(data){

                    $('#modal_button').val('Update Customer');
                    $('#customerId').val(data.customer.id);
                    $('#firstName').val(data.customer.first_name);
                    $('#lastName').val(data.customer.last_name);
                    $('#customerTitle').val(data.customer.title);
                    $('#customerEmail').val(data.customer.email);
                    $('#customerPhone').val(data.customer.phone_no);

                    if(data.company){
                        $('#companyId').val(data.company.id);
                        $('#companyName').val(data.company.name);
                        $('#companyEmail').val(data.company.email);
                        $('#companyPhone').val(data.company.phone_no);
                        $('#companyWebsite').val(data.company.website);

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
                        $('#CompanyDataAtCustomerForm').show();
                    }





                   /* $('#company_id').val(data.company.id);
                    $('#companyName').val(data.company.name);
                    $('#companyEmail').val(data.company.email);
                    $('#companyPhone').val(data.company.phone_no);
                    $('#companyWebsite').val(data.company.website);

                    if(data.company_address.length > 0){
                        $('#streetAddress_1').val(data.company_address[0].street_address_1);
                        $('#streetAddress_2').val(data.company_address[0].street_address_2);
                        $('#city_id').val(data.company_address[0].city);
                        $('#state_id').val(data.company_address[0].state);
                        $('#country_id').val(data.company_address[0].country);
                        $('#zip_id').val(data.company_address[0].zip);
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
                    text: "This Information will be trashed!",
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
                        swal("Deleted!", "Company has been deleted.", "success");

                        $.post("{{ route('delete.customer.data') }}", data, function(result){

                            console.log(result);
                            get_all_customer_data();
                            $.notify(result, "danger");
                        });
                    } else {
                        swal("Cancelled", "Company is safe :)", "error");
                    }
                });
        }


        function Select_company_create(selectVal)
        {
            if(selectVal === '1'){
                //creating customer with company
                $('#CompanyDataAtCustomerForm').show();

            }

            if(selectVal === '0'){
                //creating customer without company
                $('#CompanyDataAtCustomerForm').hide();

            }

        }

        function get_all_customer_data(){
            $("#customers-table").dataTable().fnDestroy();
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('customers-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name', searchable: false},
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone_no' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},
                    { data: 'first_name', name: 'first_name', searchable: true, visible:false},
                    { data: 'last_name', name: 'last_name', searchable: true, visible:false},
                ]
            });
        }


    </script>
@endsection