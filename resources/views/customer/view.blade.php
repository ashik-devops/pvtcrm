@extends('layouts.app')
@include('customer.create-form')
@include('appointment.create-form')
@include('journal.create-form')
@include('task.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <h2 class="view-title">{{$customer->name}}</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module">
                        <div class="module-inner">
                            <div class="side-bar">
                                <div class="user-info">
                                    {{--                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                    <ul class="meta list list-unstyled">
                                        <li class="name"><h3>{{implode(', ', array_filter([$customer->last_name, $customer->first_name]))}}</h3>
                                            <a href="{{route('view-account', [$customer->account->id])}}"><label class="label label-info">{{implode(', ', array_filter([$customer->title, $customer->account->name]))}}</label></a></li>
                                        <li>
                                            <address>
                                                <p>{{implode(', ', [$customer->addresses->first()->city, $customer->addresses->first()->state, $customer->addresses->first()->country, $customer->addresses->first()->zip])}}</p>
                                            </address>

                                        </li>
                                        <li class="email"><a href="mailto:{{$customer->email}}">{{$customer->email}}</a></li>
                                        <li class="phone"><a href="tel:{{$customer->phone_no}}">{{$customer->phone_no}}</a></li>
                                    </ul>
                                </div>

                                <nav class="side-menu">
                                    <ul class="nav nav-tabs nav-tabs-theme-2 tablist">
                                        <li class="active" role="presentation"><a href="#info" aria-controls="info" aria-expanded="true" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-user icon"></span> Info</a></li>
                                        <li role="presentation"><a href="#journals"   aria-controls="journals" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-bookmarks icon"></span> Journals</a></li>
                                        <li><a href="#tasks" role="presentation" aria-controls="tasks" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-note2 icon"></span> Tasks</a></li>
                                        <li><a href="#appointments" role="presentation" aria-controls="appointments" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-date icon"></span> Appointments</a></li>
                                        <li><a href="#addresses" role="presentation" aria-controls="addresses" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-paper-plane icon"></span> Addresses</a></li>
                                        </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <div class="tab-content">
                                    <div id="info" role="tabpanel" class="tab-pane active">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Customer Info</h3>
                                                <button class="btn btn-warning pull-right" style="margin-top:-24px;" onClick="editCustomer()" data-target="#modal-new-account"><i class="glyphicon glyphicon-edit"></i>  Edit Customer</button>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-6 col-lg6 col-sm-12 table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>Name </td>
                                                            <td>{{implode(', ', array_filter([$customer->last_name,$customer->first_name]))}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company Name </td>
                                                            <td><a href="{{route('view-account', [$customer->account->id])}}">{{$customer->account->name}}</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Title</td>
                                                            <td>{{$customer->title}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><a href="mailto:{{$customer->email}}">{{$customer->email}}</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone No</td>
                                                            <td><a href="tel:{{$customer->phone_no}}">{{$customer->phone_no}}</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Assigned User </td>
                                                            <td>{{$customer->user->name}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6 col-lg6 col-sm-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="journals" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Journal Entries</h3>
                                                <button class="btn btn-warning pull-right" style="margin-top:-24px;" onClick="createJournal()" ><i class="fa fa-plus"></i>  Create Journal</button>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="journals-list" style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Log Date</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Follow Up</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="tasks" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Tasks</h3>
                                                <button id="new-task-btn" class="btn btn-warning pull-right" style="margin-top:-24px;" onClick="createTask()" ><i class="fa fa-plus"></i>  Create Task</button>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tasks-list" style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Title</th>
                                                            <th>Customer</th>
                                                            <th>Description</th>
                                                            <th>Due Date</th>
                                                            <th>Status</th>
                                                            <th>Priority</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="appointments" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Appointments</h3>
                                                <button id="new-apt-btn" class="btn btn-warning pull-right" style="margin-top:-24px;" onClick="createAppointment()" ><i class="fa fa-plus"></i>  Create Appointment</button>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="appointments-list" style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
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
                                    <div id="addresses" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Address Book</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="address-list" style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Address</th>
                                                            <th>Type</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        {{--@foreach($customer->addresses as $address)--}}
                                                            {{--<p>{{$address->street_address_1}}</p>--}}
                                                            {{--@if(strlen($address->street_address_2)>0)--}}
                                                                {{--<p>{{$address->street_address_2}}</p>--}}
                                                            {{--@endif--}}
                                                            {{--<p>{{$address->city}} {{$address->state}} {{$address->zip}}</p>--}}
                                                            {{--<p>{{$address->country}}</p>--}}
                                                            {{--@if(strlen($address->email) > 0)--}}
                                                                {{--<p>{{$address->email}}</p>--}}
                                                            {{--@endif--}}
                                                            {{--@if(strlen($address->phone_no) > 0)--}}
                                                                {{--<p>{{$address->phone_no}}</p>--}}
                                                            {{--@endif--}}

                                                        {{--@endforeach--}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
    <div class="modal" id="new-customer" tabindex="-1" role="dialog" aria-labelledby="modal-new-customer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="new_edit_account">
                        <h4 class="modal-title" id="modal-new-ticket-label new_edit_user">Edit Customer</h4>
                    </div>

                </div>
                <div class="modal-body">
                    @yield('customer-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
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
    <div class="modal taskModal" id="task-modal" role="dialog" aria-labelledby="task-modal">
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
    <!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>

    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>

    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    -->

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>


    <script type="text/javascript">
        var task_date=moment();
        var journalDate=moment();
            var task_datatable = jQuery('#tasks-list').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                paging:true,
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                ajax: '{!! route('customer-tasks-list', [$customer->id]) !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title'},
                    { data: 'customer_name', name: 'customer_name'},
                    { data: 'description', name: 'description'},
                    { data: 'due_date', name: 'due_date' },
                    { data: 'status', name: 'status'},
                    { data: 'priority', name: 'priority'},
                    { data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });


            var appointment_datatable = jQuery('#appointments-list').DataTable({
//               responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                paging:true,
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                ajax: '{!! route('customer-appointments-list', [$customer->id]) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });


        var min_date = moment();
        var max_date = moment();


        jQuery('.modal').on('shown.bs.modal', function () {


            $('#startTime').datetimepicker({});
            $('#endTime').datetimepicker({ useCurrent: false});

            updateAppointmentDates();

            $('#taskDueDateTimePicker').datetimepicker();
            updateTaskDate();
        });

        $("#startTime").on("dp.change", function (e) {
            min_date=e.date;
            updateAppointmentDates();
        });
        $("#endTime").on("dp.change", function (e) {
            max_date=e.date;
            updateAppointmentDates();
        });



        jQuery('.modal').on('shown.bs.modal', function () {


            $('#startTime').datetimepicker({});
            $('#endTime').datetimepicker({ useCurrent: false});

            updateAppointmentDates();

            $('#taskDueDateTimePicker').datetimepicker();
            updateTaskDate();
        });


        $("#startTime").on("dp.change", function (e) {
            min_date=e.date;
        });
        $("#endTime").on("dp.change", function (e) {
            max_date=e.date;
        });

        function updateAppointmentDates(){
            $('#startTime').data("DateTimePicker").date(min_date);
            $('#startTime').data("DateTimePicker").minDate(moment());
//                $('#startTime').data("DateTimePicker").maxDate(max_date);
            $('#endTime').data("DateTimePicker").date(max_date);
            $('#endTime').data("DateTimePicker").minDate(min_date);
        }

        function updateTaskDate(){
            $('#taskDueDateTimePicker').data("DateTimePicker").date(task_date);
        }


        /*========Start Appointment Module in Company Single view =========*/
        var aptinputMap={
            appointmentId : 'appointment_id',
            aptCustomerId : 'aptCustomerId',
            appointmentTitle : 'appointmentTitle',
            appointmentDescription : 'appointmentDescription',
            appointmentStatus : 'appointmentStatus',
            startTime : 'startTime',
            endTime : 'endTime'
        };



        function createAppointment(){
            $('#appointment-modal').modal('show');
        }
        $('#appointment_modal_button').val('Add Appointment');
        $('#modal-new-appointment-label').text('Add An Appointment');
        $('#appointmentForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            //console.log('hello');

            var appointment = {
                appointmentId : $('#'+aptinputMap.appointmentId).val(),
                aptCustomerId : '{{$customer->id}}',
                appointmentTitle : $('#'+aptinputMap.appointmentTitle).val(),
                appointmentDescription : $('#'+aptinputMap.appointmentDescription).val(),
                appointmentStatus : $('#'+aptinputMap.appointmentStatus).val(),
                startTime : $('#'+aptinputMap.startTime).val(),
                endTime : $('#'+aptinputMap.endTime).val()
            };


            var data = {
                _token : _token,
                appointment: appointment
            };

            if(appointment.appointmentId === ''){
                //console.log('creating');
                var request = jQuery.ajax({
                    url: "{{ route('create.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_appointment_form($('#appointmentForm')[0]);
                        $('#appointment-modal').modal('hide');
                        get_all_appointment_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });
                request.error(function(xhr){
                    handle_apt_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    //console.log(jqXHT);
                    $.notify(textStatus, "error");
                });
            }else{
                var request = jQuery.ajax({
                    url: "{{ route('update.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_appointment_form($('#appointmentForm')[0]);
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
                    handle_apt_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }

        });
        jQuery('#new-apt-btn').click(function () {
            if($('#'+aptinputMap.appointmentId).val() != ''){
                reset_appointment_form($("#appointmentForm")[0]);
            }
        });

        jQuery('#new-task-btn').click(function () {
            //console.log($('#'+taskInputMap.taskId).val() != '');
            if($('#'+taskInputMap.taskId).val() != ''){
                reset_task_form($("#taskForm")[0]);
            }
        });

        function reset_appointment_form(form_el) {
            form_el.reset();
            min_date = moment();
            max_date = moment();
            $('#'+aptinputMap.appointmentId).val('');
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
                    min_date = moment(data.appointment.start_time);
                    max_date = moment(data.appointment.end_time);

                    updateAppointmentDates();

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

            appointment_datatable.ajax.reload(null, false);
        }

        function showAptParselyError(field, msg){

            var el = jQuery("#"+aptinputMap[field]).parsley();
            console.log(el);
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }


        /*========End Appointment Module in Company Single view =========*/

        /*========Start Task Module in Company Single view =========*/

        var taskInputMap={
            taskId : 'task_id',
            taskCustomerId : 'taskCustomerId',
            taskTitle : 'taskTitle',
            taskDescription : 'taskDescription',
            taskDueDate : 'taskDueDate',
            taskStatus : 'taskStatus',
            taskPriority : 'taskPriority',
        };
        //updating task
        $('#task_modal_button').val('Add Task');
        $('#modal-new-task-label').text('Add A Task');
        $('#taskForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            //console.log('hello');
            var task = {
                taskId : $('#'+taskInputMap.taskId).val(),
                taskCustomerId : "{{$customer->id}}",
                taskTitle : $('#'+taskInputMap.taskTitle).val(),
                taskDescription : $('#'+taskInputMap.taskDescription).val(),
                taskDueDate : $('#'+taskInputMap.taskDueDate).val(),
                taskStatus : $('#'+taskInputMap.taskStatus).val(),
                taskPriority : $('#'+taskInputMap.taskPriority).val(),

            };
            var data = {
                _token : _token,
                task: task
            };


            if(task.taskId === ''){
                //task editing.....
                var request = jQuery.ajax({
                    url: "{{ route('create.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_task_form($('#taskForm')[0]);
                        $('#task-modal').modal('hide');
                        get_all_task_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });
                request.error(function(xhr){
                    handle_task_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });


            }else{

                var request = jQuery.ajax({
                    url: "{{ route('update.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_task_form($('#taskForm')[0]);
                        $('#task_id').val('');
                        $('#task-modal').modal('hide');
                        get_all_task_data();
                        jQuery.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })
                request.error(function(xhr){
                    handle_task_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }
        });

        function reset_task_form(form_el) {
            form_el.reset();
            $('#task_id').val('');

        }
        function createTask(){

            $('#task-modal').modal('show');
        }


        function editTask(id){
            $('#task_modal_button').val('Update Task');
            $('#modal-new-task-label').text('Edit Task');

            $.get("{{ route('edit.task.data') }}", { id: id} ,function(data){
                //console.log(data);
                if(data){
                    $('#task_id').val(data.task.id);
                     $('#taskTitle').val(data.task.title);
                    $('#taskDescription').val(data.task.description);
                    task_date = moment(data.task.due_date);
                    $('#taskPriority').val(data.task.priority);
                    $('#taskStatus').val(data.task.status);
                    updateTaskDate();
                }

            });

            $('#task-modal').modal('show');
        }





        function deleteTask(id){
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


                        $.post("{{ route('delete.task') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Task has been deleted.", "success");
                                get_all_task_data();
                                $.notify('Task deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the task", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Task is safe :)", "error");
                    }
                });


            function viewTask(id){

                $.get("{{ route('edit.task.data') }}", { id: id} ,function(data){
                    //console.log(data.task);
                    if(data){
                        $('#task_id').val(data.task.id);
                        $('#viewTaskCustomer').html(data.task.customer.first_name+', '+ data.task.customer.last_name+'@'+data.task.customer.account.name);

                        $('#viewTaskTitle').html(data.task.title);
                        $('#taskDescription').html(data.task.description);
                        $('#viewTaskDeadline').html(data.task.due_date);

                        //task_date = moment(data.task.due_date);
                        $('#viewTaskPriority').html(data.task.priority);
                        $('#viewTaskStatus').html(data.task.status);
                        if(data.task.status == "Done" || data.task.status == "Complete"){
                            $("#complete-task-button").hide();
                            $("#cancel-task-button").hide();
                        }
                        else {
                            $("#complete-task-button").show();
                            $("#cancel-task-button").show();

                        }
                    }
                });

                $('#task-modal-view').modal('show');
                $('#taskIdForView').val(id);

            }
        }

        function get_all_task_data(){
            task_datatable.ajax.reload(null, false);
        }

        function handle_task_error(xhr) {

            if(xhr.status==422){
                jQuery.map(jQuery.parseJSON(xhr.responseText), function (data, key) {
                    showTaskParselyError(key, data[0]);
                });
            }

        }
        function handle_apt_error(xhr) {

            if(xhr.status==422){
                jQuery.map(jQuery.parseJSON(xhr.responseText), function (data, key) {
                    showAptParselyError(key, data[0]);
                });
            }

        }

        function showTaskParselyError(field, msg){
            console.log(field);
            var el = jQuery("#"+taskInputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }

        function editTaskWithClosingView(){
            var id = $('#taskIdForView').val();

            $('#task-modal-view').modal('hide');


            editTask(id);

        }


        /*========End Task Module in Company Single view =========*/

        var custInputMap = {
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

        function editCustomer(){

            jQuery("#modal_button").val("Update");
            $.get("{{ route('get.customer.data') }}", { id: '{{$customer->id}}' } ,function(data){

                jQuery(".customerModal .modal-title").html('Edit Customer');

                if(data){

                    $('#modal_button').val('Update Customer');
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


                }
            });


            $('#new-customer').modal('show');

        }
        //This update code for updating account from account single view page....





        $('#customerForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();

            var customer = {
                customerId : '{{$customer->id}}',
                userId : $('#'+custInputMap.userId).val(),
                firstName : $('#'+custInputMap.firstName).val(),
                lastName : $('#'+custInputMap.lastName).val(),
                customerTitle : $('#'+custInputMap.customerTitle).val(),
                customerEmail : $('#'+custInputMap.customerEmail).val(),
                customerPhone : $('#'+custInputMap.customerPhone).val(),
                customerPriority : $('#'+custInputMap.customerPriority).val(),
            };

            var account = {
                accountId : $('#'+custInputMap.accountId).val(),
                accountNo : $('#'+custInputMap.accountNo).val(),
                addressId : $('#'+custInputMap.addressId).val(),
                accountName : $('#'+custInputMap.accountName).val(),
                accountEmail : $('#'+custInputMap.customerEmail).val(),
                accountPhone : $('#'+custInputMap.customerPhone).val(),
                accountWebsite : $('#'+custInputMap.accountWebsite).val(),
                streetAddress_1 : $('#'+custInputMap.streetAddress_1).val(),
                streetAddress_2 : $('#'+custInputMap.streetAddress_2).val(),
                city : $('#'+custInputMap.city).val(),
                state : $('#'+custInputMap.state).val(),
                country : $('#'+custInputMap.country).val(),
                zip : $('#'+custInputMap.zip).val()
            };


            var data = {
                _token : _token,
                account: account,
                customer:customer
            };




                //updating customer.....

                var request = jQuery.ajax({
                    url: "{{ route('update.customer.data') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_cust_form($('#customerForm')[0]);
                        jQuery("#accountId").html("");
                        $('#modal-new-member').modal('hide');
                        $.notify(response.message, "success");
                        setTimeout(function () {
                            location.reload()
                        }, 200)
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });
                request.error(function(xhr){
                    handle_customer_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });

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

        function handle_customer_error(xhr) {
            if(xhr.status==422){
                jQuery.map(jQuery.parseJSON(xhr.responseText), function (data, key) {
                    showCustParselyError(key, data[0]);
                });
            }
        }
        function showCustParselyError(field, msg){
            if(field.indexOf('.')>=0){
                field=field.split('.')[1];
            }
            var el = jQuery("#"+custInputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }

        function reset_cust_form(el) {
            el.reset();
            jQuery("#"+custInputMap.addressId).val('');
            jQuery("#"+custInputMap.accountId).val('0');
        }


        /*========Start Journal Module in Company Single view =========*/



        var journal_datatable = jQuery('#journals-list').DataTable({
//               responsive: false,
            select: true,
            processing: true,
            serverSide: true,
            paging:true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            ajax: '{!! route('customer-journal-data', $customer->id) !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'log_date', name: 'log_date'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'followup', name: 'followup', orderable: false, searchable:false},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });




        function createJournal(){
            $('#modal-new-journal-label').text('Edit Journal');
            $('#FollowupSection').show();
            journalDate=moment();
            reset_journal_form($('#journalForm')[0]);


            jQuery('.modal').on('shown.bs.modal', function () {
                $('#logDateTimePicker').datetimepicker();

            });
            $('#journal-modal').modal('show');
        }







        $('#journalForm').on('submit',function(e) {
            e.preventDefault();
            var _token = $('input[name="_token"]').val();

            var journal = {
                journalId : $('#'+journalInputMap.journalId).val(),
                journalCustomerId : "{{$customer->id}}",
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
            };


            if(journal.journalId === ''){
                var request = jQuery.ajax({
                    url: "{{ route('create.journal') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {

                    if(response.result == 'Saved'){
                        reset_journal_form($('#journalForm')[0]);
                        $('#journal-modal').modal('hide');
                        get_all_journal_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });

            }else{
                //journal updating

                var request = jQuery.ajax({
                    url: "{{ route('update.journal') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_journal_form($('#journalForm')[0]);
                        $('#journal-modal').modal('hide');
                        get_all_journal_data();
                        jQuery.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }

        });




        function editJournal(id){

            $('#journal_modal_button').val('Update Journal');
            $('#modal-new-journal-label').text('Edit Journal');
            $('#FollowupSection').hide();
            $.get("{{ route('edit.journal.data') }}", { id: id} ,function(data){
                if(data){
                    $('#journal_id').val(data.journal.id);
                    $('#journalTitle').val(data.journal.title);
                    $('#journalDescription').val(data.journal.description);
                    journalDate=moment(data.journal.log_date);
                    updateJournalDates();
                }

            });
            $('#journal-modal').modal('show');
        }
        function updateJournalDates(){
            jQuery("#journalLogDate").data("DateTimePicker").date(journalDate);
            jQuery("#journalLogDate").data("DateTimePicker").minDate(moment());

        }
        function get_all_journal_data(){
            journal_datatable.ajax.reload(null, false);
        }
        /*========End Journal Module in Company Single view =========*/

        jQuery(document).ready(function (){
            jQuery("#journalCustomerId").hide();
            jQuery("#taskCustomerId").hide();
            jQuery("#aptCustomerId").hide();
        });
    </script>

@endsection