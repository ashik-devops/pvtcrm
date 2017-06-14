@extends('layouts.app')
@include('customer-company.create-form')

@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Customer Companies</h2>
            <div class="actions">
                <button class="btn btn-success" id="new-company" data-toggle="modal" data-target="#modal-new-company"><i class="fa fa-plus"></i> New Company</button>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                <h3 class="module-title">Customer Companies</h3>
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
    <!--modal for creating Customer Company-->
    <div class="modal" id="modal-new-company" tabindex="-1" role="dialog" aria-labelledby="modal-new-company">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="new_edit_company">
                        <h4 class="modal-title" id="modal-new-ticket-label new_edit_user">Create New Company</h4>
                    </div>

                </div>
                <div class="modal-body">
                    @yield('customer-create-from')
                </div>
            </div>
        </div>
    </div><!--/modal-->




@section('after-footer-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    {{--Build the datatables--}}
    <script type="text/javascript">
        jQuery('document').ready(function() {
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email' },
                    { data: 'phone_no', name: 'phone_no' },
                    { data: 'website', name: 'website' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });

        });


    </script>

    {{--Handle create form submission--}}
   <!-- <script type="text/javascript">
        jQuery('document').ready(function() {
            jQuery('form.ajax-from').submit(function (e) {

                //clear errors
                jQuery('span.help-block').remove();
                jQuery('.has-error').removeClass('has-error');

                var url = jQuery(this).attr('action'); // the script where you handle the form input.
                var data= jQuery(this).serialize();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data, // serializes the form's elements.
                    success: function(data)
                    {
//                        alert(data); // show response from the php script.
                    },
                    error : function (data ) {
                        var errors = data.responseJSON;
                        console.log(errors);
                        for(var key in errors)
                        {
                            var el = jQuery('#'+key);

                            el.addClass('has-error');
                            el.append("<span class='help-block'><strong>"+errors[key][0]+"</strong></span>");


                        }
                    }

                });

                e.preventDefault();

            });
        });


    </script>-->
@endsection

@section('company-create-edit-delete-scripts')

    <script>
        $(document).ready(function(){
            jQuery("button#new-company").click(function (){
                $('#new_edit_company .modal-title').html('Create New Company');
            });
            //For creating Company....
            $('#companyForm').on('submit',function(e){
                e.preventDefault();
                var _token = $('input[name="_token"]').val();

                var company = {
                    companyId : $('#company_id').val(),
                    addressId : $('#address_id').val(),
                    companyName : $('#companyName').val(),
                    companyEmail : $('#companyEmail').val(),
                    companyPhone : $('#companyPhone').val(),
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
                    company: company
                };

                if(company.companyId === ''){
                    //company creating.....


                    var request = jQuery.ajax({
                        url: "{{ route('create.company') }}",
                        data: data,
                        method: "POST",
                        dataType: "json"
                    });
                    request.done(function (response) {
                        if(response.result == 'Saved'){
                            $('#companyForm')[0].reset();
                            $('#modal-new-company').modal('hide');
                            get_all_company_data();
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
                    //company editing.....

                    var request = jQuery.ajax({
                        url: "{{ route('update.company') }}",
                        data: data,
                        method: "POST",
                        dataType: "json"
                    });
                    request.done(function (response) {
                        if(response.result == 'Saved'){
                            $('#companyForm')[0].reset();
                            $('#company_id').val('');
                            $('#modal-new-company').modal('hide');
                            get_all_company_data();
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
        });

        function editCompany(id){

            $('#new_edit_company .modal-title').html('Edit Company');

            $.get("{{ route('edit.modal.data') }}", { id: id} ,function(data){
                if(data){
                    $('#modal_button').val('Update Company');
                    $('#company_id').val(data.company.id);
                    $('#companyName').val(data.company.name);
                    $('#companyEmail').val(data.company.email);
                    $('#companyPhone').val(data.company.phone_no);
                    $('#companyWebsite').val(data.company.website);

                    if(data.company_address.length > 0){
                        $('#address_id').val(data.company_address[0].id);
                        $('#streetAddress_1').val(data.company_address[0].street_address_1);
                        $('#streetAddress_2').val(data.company_address[0].street_address_2);
                        $('#city_id').val(data.company_address[0].city);
                        $('#state_id').val(data.company_address[0].state);
                        $('#country_id').val(data.company_address[0].country);
                        $('#zip_id').val(data.company_address[0].zip);
                    }
                }
            });
            $('#modal-new-company').modal('show');
        }




        function deleteCompany(id){
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

                        $.post("{{ route('delete.company') }}", data, function(result){

                            //console.log(result);
                            get_all_company_data();
                            $.notify(result, "danger");
                        });
                    } else {
                        swal("Cancelled", "Company is safe :)", "error");
                    }
                });
        }

        function get_all_company_data(){
            //$('#customers-table').html('');
            $("#customers-table").dataTable().fnDestroy();
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email' },
                    { data: 'phone_no', name: 'phone_no' },
                    { data: 'website', name: 'website' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        }
    </script>
@endsection