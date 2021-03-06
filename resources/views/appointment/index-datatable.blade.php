@extends('layouts.app')
@include('appointment.create-form')
@include('appointment.appointment-view')
@include('journal.create-form')
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
                    <button id="new-apt-btn" class="btn btn-success" data-toggle="modal" data-target="#appointment-modal"><i class="fa fa-plus"></i>New Appointment</button>
                </div>

            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">Appointment</h3>--}}

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
                                                    <th>Status</th>
                                                    <th></th>
                                                    <th></th>
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
    <div class="modal customerModal" id="appointment-modal-complete" role="dialog" aria-labelledby="appointment-modal-complete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-complete-appointment-label">Complete Appointment</h4>
                </div>
                <div class="modal-body">
                    @yield('journal-create-form')
                </div>
            </div>
        </div>
    </div>
    <!--/modal-->
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
    @yield('journal-create-form-script')
    <script type="text/javascript">
        var min_date = moment();
        var max_date = moment();

        var inputMap={
            appointmentId : 'appointment_id',
            aptCustomerId : 'aptCustomerId',
            appointmentTitle : 'appointmentTitle',
            appointmentDescription : 'appointmentDescription',
            appointmentStatus : 'appointmentStatus',
            startTime : 'startTime',
            endTime : 'endTime'
        };


            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                paging:true,
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                ajax: '{!! route('appointment-data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'description', name: 'description'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'status', name: 'status'},
                    {data: 'customer_first_name', name: 'customer_first_name', visible: false },
                    {data: 'customer_last_name', name: 'customer_last_name' , visible: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ]
            });


            var customer_select =  jQuery("#aptCustomerId").select2({



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
                        //console.log(data);
                        return {
                            results: data.customers
                        }
                    },

                    cache: true
                }
            });

            jQuery('.modal').on('shown.bs.modal', function () {


                    $('#startTime').datetimepicker({});
                    $('#endTime').datetimepicker({ useCurrent: false});



                updateDates();


            });

        $("#startTime").on("dp.change", function (e) {
            min_date=e.date;
            updateDates();
        });
        $("#endTime").on("dp.change", function (e) {
            max_date=e.date;
            updateDates();
        });

        jQuery('#new-apt-btn').click(function () {
//            if($('#'+inputMap.appointmentId).val() != '' || $('#'+inputMap.aptCustomerId).val() != ''){
//                reset_form($("#appointmentForm")[0]);
//            }
            reset_form('appointmentForm');
        });

        function updateDates(){
                $('#startTime').data("DateTimePicker").date(min_date);
                $('#startTime').data("DateTimePicker").minDate(moment());
//                $('#startTime').data("DateTimePicker").maxDate(max_date);
                $('#endTime').data("DateTimePicker").date(max_date);
                $('#endTime').data("DateTimePicker").minDate(min_date);
        }

        //creating appointment
        $('#appointment_modal_button').val('Add Appointment');
        $('#modal-new-appointment-label').text('Add An Appointment');
        $('#appointmentForm').on('submit',function(e){
            e.preventDefault();
            if(!$(this).parsley().isValid()){
                return;
            }
            var _token = $('input[name="_token"]').val();
            //console.log('hello');
            var appointment = {
                appointmentId : $('#'+inputMap.appointmentId).val(),
                aptCustomerId : parseInt($('#'+inputMap.aptCustomerId).val()),
                appointmentTitle : $('#'+inputMap.appointmentTitle).val(),
                appointmentDescription : $('#'+inputMap.appointmentDescription).val(),
                appointmentStatus : $('#'+inputMap.appointmentStatus).val(),
                startTime : $('#'+inputMap.startTime).val(),
                endTime : $('#'+inputMap.endTime).val()
            };

           //console.log(appointment);
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
                        reset_form($('#appointmentForm')[0]);
                        $('#appointment-modal').modal('hide');
                        get_all_appointment_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });
                request.error(function(xhr){
                    handle_error(xhr);
                });
                    request.fail(function (jqXHT, textStatus) {
                    console.log(jqXHT);
                    $.notify(textStatus, "error");
                });
            }else{
                //console.log(appointment);
                //appointment updating.....

                var request = jQuery.ajax({
                    url: "{{ route('update.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#appointmentForm')[0]);
                        $('#appointment_id').val('');
                        $('#appointment-modal').modal('hide');
                        get_all_appointment_data();
                        jQuery.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })
                request.error(function(xhr){
                    jQuery.map(jQuery.parseJSON(xhr.responseText),function (data, key){
                        handle_error(xhr);
                    });



                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }

        });
        function handle_error(xhr) {
            if(xhr.status==422){
                jQuery.map(jQuery.parseJSON(xhr.responseText), function (data, key) {
                    showParselyError(key, data[0]);
                });
            }
        }

        function showParselyError(field, msg){
            if(field.indexOf('.')>=0){
                field=field.split('.').reverse()[0];
            }
            var el = jQuery("#"+inputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }

        function reset_form(el) {
//            form_el.reset();
//            task_date=moment();
//            $('#'+inputMap.taskId).val('');
//            task_customer_select.val('').trigger('change');



            jQuery("#"+el)[0].reset();
            jQuery("#"+el).parsley().reset();

            jQuery("#"+inputMap.addressId).val('');
            jQuery("#"+inputMap.customerId).val('');
            jQuery("#"+inputMap.accountId).val('0');
            jQuery("#"+inputMap.appointmentId).val();

        }


        function editAppointment(id){

            $('#appointment_modal_button').val('Update Appointment');
            $('#modal-new-appointment-label').text('Edit Appointment');

            $.get("{{ route('edit.appointment') }}", { id: id} ,function(data){
                //console.log(data.appointment);
                if(data){
                    jQuery('#appointment_id').val(data.appointment.id);
                    jQuery('#appointmentTitle').val(data.appointment.title);
                    jQuery('#appointmentDescription').val(data.appointment.description);
                    jQuery('#appointmentStatus').val(data.appointment.status);
                    $('#aptCustomerId').val(data.appointment.customer_id);
                    $('#aptCustomerId').html("<option selected value='"+data.appointment.customer.id+"'>"+data.appointment.customer.first_name+', '+ data.appointment.customer.last_name+'@'+data.appointment.customer.account.name+"</option>");

                    min_date = moment(data.appointment.start_time);
                    max_date = moment(data.appointment.end_time);

                    updateDates();

                }

            });

            $('#appointment-modal').modal('show');
        }


        {{--function deleteAppointment(id){--}}
            {{--var _token = $('input[name="_token"]').val();--}}
            {{--var data = {--}}
                {{--_token : _token,--}}
                {{--id: id--}}
            {{--};--}}
            {{--swal({--}}
                    {{--title: "Are you sure?",--}}
                    {{--text: "This Information will be trashed!",--}}
                    {{--type: "warning",--}}
                    {{--showCancelButton: true,--}}
                    {{--confirmButtonColor: "#DD6B55",--}}
                    {{--confirmButtonText: "Yes, delete it!",--}}
                    {{--cancelButtonText: "No, cancel !",--}}
                    {{--closeOnConfirm: false,--}}
                    {{--closeOnCancel: false--}}
                {{--},--}}
                {{--function(isConfirm){--}}
                    {{--if (isConfirm) {--}}

                        {{--//deletion process is going on....--}}


                        {{--$.post("{{ route('delete.appointment') }}", data, function(result){--}}

                            {{--if(result.result == 'Success'){--}}
                                {{--swal("Deleted!", "Appointment has been deleted.", "success");--}}
                                {{--get_all_appointment_data();--}}
                                {{--$.notify('Appointment deleted successfully', "danger");--}}
                            {{--}--}}
                            {{--else{--}}
                                {{--swal("Failed", "Failed to delete the Appointment", "error");--}}
                            {{--}--}}

                        {{--});--}}
                    {{--} else {--}}
                        {{--swal("Cancelled", "Appointment is safe :)", "error");--}}
                    {{--}--}}
                {{--});--}}
        {{--}--}}


        function get_all_appointment_data(){


            datatable.ajax.reload(null, false);
        }






        function closeAppointment(id, status){

            $('#journal_modal_button').val(status+ ' Appointment');
            $('#modal-complete-appointment-label').val(status+ ' Appointment');
            if(status=='Complete'){
                status='Done';
            }
            else if(status=='Cancel'){
                status = 'Cancelled';
            }

            $('#origin_id').val(id);
            $('#journal-customer-id').remove();

            $('#appointment-modal-complete').modal('show');
            $('#journalForm').on('submit',function(e) {
                e.preventDefault();

                var _token = $('input[name="_token"]').val();

                var journal = {
                    originId : $('#'+journalInputMap.originId).val(),
                    journalTitle : $('#'+journalInputMap.journalTitle).val(),
                    journalDescription : $('#'+journalInputMap.journalDescription).val(),
                    journalLogDate : $('#'+journalInputMap.journalLogDate).val(),
                };
                if($('input[name=followUpType]:checked').val() === 'appointment'){
                    journal.followup = {
                        type : 'appointment',
                        followupAppointmentTitle : $('#'+journalInputMap.followupAppointmentTitle).val(),
                        appointmentDescription : $('#f'+journalInputMap.followupAppointmentDescription).val(),
                        followupAppointmentDescription : $('#'+journalInputMap.followupAppointmentStartTime).val(),
                        followupAppointmentStartTime : $('#'+journalInputMap.followupAppointmentStartTime).val(),
                        followupAppointmentEndTime : $('#'+journalInputMap.followupAppointmentEndTime).val()
                    };
                }

                else if($('input[name=followUpType]:checked').val() === 'task'){
                    journal.followup = {
                        type : 'task',
                        followupTaskTitle : $('#'+journalInputMap.followupTaskTitle).val(),
                        followupTaskDescription : $('#'+journalInputMap.followupTaskDescription).val(),
                        followupTaskDueDate : $('#'+journalInputMap.followupTaskDueDate).val(),
                        followupTaskPriority : $('#'+journalInputMap.followupTaskPriority).val(),
                    };
                }

                var data = {
                    _token : _token,
                    journal: journal,
                    action: status
                };



                var request = jQuery.ajax({
                    url: "{{ route('close.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {

                    if(response.result == 'Saved'){
                        reset_journal_form($('#journalForm')[0]);
                        $('#appointment-modal-complete').modal('hide');
                        get_all_appointment_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });

                request.fail(function (jqXHT, textStatus) {
                    $.notify(jqXHT.responseJSON.message, "error");
                });



            });

        }





        function viewAppointment(id){

            $.get("{{ route('edit.appointment') }}", { id: id} ,function(data){
                //console.log(data.task);
                if(data){
                    $('#appointment_id').val(data.appointment.id);
                    $('#viewAppointmentCustomer').html(data.appointment.customer.first_name+', '+ data.appointment.customer.last_name+'@'+data.appointment.customer.account.name);

                    $('#viewAppointmentTitle').html(data.appointment.title);
                    $('#viewAppointmentDescription').html(data.appointment.description);
                    $('#viewAppointmentStart_time').html(data.appointment.start_time);
                    $('#viewAppointmentEnd_time').html(data.appointment.end_time);

                    //task_date = moment(data.task.due_date);
                    //$('#viewTaskPriority').html(data.task.priority);

                    $('#viewAppointmentStatus').html(data.appointment.status);
                    if(data.appointment.status == "Done" || data.appointment.status == "Complete"||data.appointment.status == "Cancel" || data.appointment.status == "Cancelled"){
                        $("#complete-appointment-button").hide();
                        $("#cancel-appointment-button").hide();
                        $("#edit-appointment-button").hide();

                    }
                    else {
                        $("#complete-appointment-button").show();
                        $("#cancel-appointment-button").show();
                        $("#edit-appointment-button").show();

                    }
                    //updateDates();
                    //var id = data.task.id;
                    //console.log(id);

                }

            });

            $('#appointment-modal-view').modal('show');
            $('#appointmentIdForView').val(id);


        }


        function editAppointmentWithClosingView(){
          var id = $('#appointmentIdForView').val();

            $('#appointment-modal-view').modal('hide');


            editAppointment(id);

        }



        function completeAppointmentWithClosingView(){
            var id = $('#appointmentIdForView').val();

            $('#appointment-modal-view').modal('hide');


            closeAppointment(id, 'Complete');

        }

        function cancelAppointmentWithClosingView(id){
            var id = $('#appointmentIdForView').val();

            $('#appointment-modal-view').modal('hide');


            closeAppointment(id, 'Cancel');

        }

        function cancelAppointment(id) {
            var id = $('#appointmentIdForView').val();

            $('#appointment-modal-view').modal('hide');


            closeAppointment(id, 'Cancel');
        }


    </script>
@endsection