@extends('layouts.app')
@include('appointment.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">

    <style type="text/css">
        .datetimepicker{
            z-index: 999 !important;
        }
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Appointments</h2>
            <div class="actions">
                <button id="new-customer-btn" class="btn btn-success" data-toggle="modal" data-target="#appointment-modal"><i class="fa fa-plus"></i> New Appointment</button>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                <h3 class="module-title">Appointment</h3>
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
                                                    <th>Title</th>
                                                    <th>Customer</th>

                                                    <th>Description</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
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
@endsection



@section('after-footer-script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script type="text/javascript">
        jQuery('document').ready(function() {


            /*$.get("{!! route('appointment-data') !!}", function(data, status){
                console.log(data);
            }); */
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('appointment-data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'description', name: 'description'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ]
            });

            jQuery("#aptCustomerId").select2({
                placeholder: "Select a Customer",
                allowClear:true,
                ajax: {
                    url: "{{route('get-customer-options')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults : function (data){
                        console.log(data);
                        return {
                            results: data.customers
                        }
                    },

                    cache: true
                }
            });

            jQuery('.modal').on('shown.bs.modal', function () {

                jQuery(function () {
                    $('#start_timeTimePicker').datetimepicker();
                    $('#end_timeTimePicker').datetimepicker();
                });

            });
        });

        //creating appointment
        $('#appointment_modal_button').val('Add Appointment');
        $('#modal-new-appointment-label').text('Add An Appointment');
        $('#appointmentForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            console.log('hello');

            var appointment = {
                appointmentId : $('#appointment_id').val(),
                aptCustomerId : $('#aptCustomerId').val(),
                appointmentTitle : $('#appointmentTitle').val(),
                appointmentDescription : $('#appointmentDescription').val(),
                appointmentStatus : $('#appointmentStatus').val(),
                startTime : $('#startTime').val(),
                endTime : $('#endTime').val()
            };

           // console.log(appointment);
            var data = {
                _token : _token,
                appointment: appointment
            };

            if(appointment.appointmentId === ''){
                //appointment creating.....

                var request = jQuery.ajax({
                    url: "{{ route('create.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        $('#appointmentForm')[0].reset();
                        $('#appointment-modal').modal('hide');
                        get_all_appointment_data();
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
                console.log(appointment);
                //appointment editing.....

                var request = jQuery.ajax({
                    url: "{{ route('update.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        $('#appointmentForm')[0].reset();
                        $('#appointment_id').val('');
                        $('#appointment-modal').modal('hide');
                        get_all_appointment_data();
                        jQuery.notify(response.message, "success");
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

        function editAppointment(id){

            $('#appointment_modal_button').val('Update Appointment');
            $('#modal-new-appointment-label').text('Edit Appointment');

            $.get("{{ route('edit.appointment') }}", { id: id} ,function(data){
                console.log(data.appointment);
                if(data){
                    jQuery('#appointment_id').val(data.appointment.id);
                    jQuery('#appointmentTitle').val(data.appointment.title);
                    jQuery('#appointmentDescription').val(data.appointment.description);
                    jQuery('#appointmentStatus').val(data.appointment.status);
                    $('#aptCustomerId').val(data.appointment.customer_id);
                    $('#aptCustomerId').html("<option selected value='"+data.appointment.customer.id+"'>"+data.appointment.customer.first_name+', '+ data.appointment.customer.last_name+'@'+data.appointment.customer.company.name+"</option>");

                    jQuery('#startTime').datetimepicker({date: data.appointment.start_time});
                    jQuery('#endTime').datetimepicker({date: data.appointment.end_time});


                }

            });

            $('#appointment-modal').modal('show');
        }


        function deleteAppointment(id){
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


                        $.post("{{ route('delete.appointment') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Appointment has been deleted.", "success");
                                get_all_appointment_data();
                                $.notify('Appointment deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the Appointment", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Appointment is safe :)", "error");
                    }
                });
        }


        function get_all_appointment_data(){
            $("#customers-table").dataTable().fnDestroy();
            var datatable = jQuery('#customers-table').DataTable({
//              select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('appointment-data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'description', name: 'description'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ]
            });
        }


    </script>
@endsection