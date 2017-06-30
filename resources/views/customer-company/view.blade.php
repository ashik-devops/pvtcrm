@extends('layouts.app')
@include('appointment.create-form')
@include('task.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view view-account">
        <div class="container-fluid">
            <h2 class="view-title">{{$company->name}}</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module">
                        <div class="module-inner">
                            <div class="side-bar">
                                <div class="user-info">
                                    {{--                                    <img class="img-profile img-circle img-responsive center-block" src="{{asset('storage/'.$user->profile->profile_pic)}}" alt="" />--}}
                                    <ul class="meta list list-unstyled">
                                        <li class="name"><h3>{{$company->name}}</h3>
                                            <label class="label label-info"></label></li>
                                        <li>
                                            <address>
                                                <p>{{implode(', ', [$company->addresses->first()->city, $company->addresses->first()->state, $company->addresses->first()->country, $company->addresses->first()->zip])}}</p>
                                            </address>

                                        </li>
                                        <li class="email"><a href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                                        <li class="phone"><a href="tel:{{$company->phone_no}}">{{$company->phone_no}}</a></li>
                                        <li class="website"><a href="{{$company->website}}">{{$company->website}}</a></li>
                                    </ul>
                                </div>

                                <nav class="side-menu">
                                    <ul class="nav nav-tabs nav-tabs-theme-2 tablist">
                                        <li class="active" role="presentation"><a href="#info" aria-controls="info" aria-expanded="true" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-user icon"></span> Info</a></li>
                                        <li role="presentation"><a href="#journals"   aria-controls="journals" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-bookmarks icon"></span> Journals</a></li>
                                        <li><a href="#tasks" role="presentation" aria-controls="tasks" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-note2 icon"></span> Tasks</a></li>
                                        <li><a href="#appointments" role="presentation" aria-controls="appointments" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-date icon"></span> Appointments</a></li>
                                        <li><a href="#addresses" role="presentation" aria-controls="addresses" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-paper-plane icon"></span> Addresses</a></li>
                                        <li><a href="#employees" role="presentation" aria-controls="employees" aria-expanded="false" role="tab" data-toggle="tab"><span class="pe-icon pe-7s-users icon"></span>Contacts</a></li>
                                    </ul>
                                </nav>

                            </div>

                            <div class="content-panel">
                                <div class="tab-content">
                                    <div id="info" role="tabpanel" class="tab-pane active">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Company Info</h3>
                                            </div>
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin luctus pharetra faucibus. Cras leo dui, tempor vitae lacus sit amet, lacinia porta eros. Aliquam et mauris vitae arcu sollicitudin vehicula quis ac nisl. Pellentesque sapien sapien, pharetra nec metus vel, tincidunt pretium elit.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="journals" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Journal Entries</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="panel-group panel-group-theme-1" id="accordion-2" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading panel-heading-theme-1" role="tab" id="headingOne-2">
                                                            <h4 class="panel-title"><a class="active collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#collapseOne-2" aria-expanded="false" aria-controls="collapseOne-2"><i class="fa fa-plus-square"></i> Collapsible Group Item #1</a></h4>
                                                        </div>

                                                        <div id="collapseOne-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne-2" aria-expanded="false" style="height: 0px;">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading panel-heading-theme-1" role="tab" id="headingTwo-2">
                                                            <h4 class="panel-title"><a class="" data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-2" aria-expanded="true" aria-controls="collapseTwo-2"><i class="fa fa-minus-square"></i> Collapsible Group Item #2</a></h4>
                                                        </div>

                                                        <div id="collapseTwo-2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo-2" aria-expanded="true" style="">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading panel-heading-theme-1" role="tab" id="headingThree-2">
                                                            <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#collapseThree-2" aria-expanded="false" aria-controls="collapseThree-2"><i class="fa fa-plus-square"></i> Collapsible Group Item #3</a></h4>
                                                        </div>

                                                        <div id="collapseThree-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree-2" aria-expanded="false">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="tasks" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Tasks</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="tasks-list" style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Status</th>
                                                            <th>Due Date</th>
                                                            <th>Priority</th>
                                                            <th>Actions</th>
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
                                                <div class="panel-group panel-group-theme-1" id="accordion-2" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading panel-heading-theme-1" role="tab" id="headingOne-2">
                                                            <h4 class="panel-title"><a class="active collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#collapseOne-2" aria-expanded="false" aria-controls="collapseOne-2"><i class="fa fa-plus-square"></i> Collapsible Group Item #1</a></h4>
                                                        </div>

                                                        <div id="collapseOne-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne-2" aria-expanded="false" style="height: 0px;">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading panel-heading-theme-1" role="tab" id="headingTwo-2">
                                                            <h4 class="panel-title"><a class="" data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-2" aria-expanded="true" aria-controls="collapseTwo-2"><i class="fa fa-minus-square"></i> Collapsible Group Item #2</a></h4>
                                                        </div>

                                                        <div id="collapseTwo-2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo-2" aria-expanded="true" style="">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading panel-heading-theme-1" role="tab" id="headingThree-2">
                                                            <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#collapseThree-2" aria-expanded="false" aria-controls="collapseThree-2"><i class="fa fa-plus-square"></i> Collapsible Group Item #3</a></h4>
                                                        </div>

                                                        <div id="collapseThree-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree-2" aria-expanded="false">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="employees" role="tabpanel" class="tab-pane">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Contact Persons</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Location</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($company->employees as $employee)
                                                            <tr>
                                                                <td>{{implode(', ', array_filter([$employee->last_name, $employee->first_name]))}}</td>
                                                                <td>{{$employee->title}}</td>
                                                                <td>{{implode(', ', array_filter([$employee->addresses->first()->city, $employee->addresses->first()->state, $employee->addresses->first()->country, $employee->addresses->first()->zip]))}}</td>
                                                                <td><a href="#" class="btn btn-success">View</a></td>
                                                            </tr>
                                                        @endforeach
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
    <div class="modal customerModal" id="task-modal" role="dialog" aria-labelledby="task-modal">
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

    <script type="text/javascript">
        jQuery('document').ready(function() {
            jQuery('#tasks-list').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-tasks-list', [$company->id]) !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title'},
                    { data: 'status', name: 'status' },
                    { data: 'due_date', name: 'due_date' },
                    { data: 'priority', name: 'priority' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
            jQuery('#appointments-list').DataTable({
//               responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-appointments-list', [$company->id]) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });

        });



    </script>

    <script type="text/javascript">
        var min_date = moment();
        var max_date = moment();



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
        });
        $("#endTime").on("dp.change", function (e) {
            max_date=e.date;
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
            var _token = $('input[name="_token"]').val();
            //console.log('hello');

            var appointment = {
                appointmentId : $('#appointment_id').val(),
                aptCustomerId : $('#aptCustomerId').val(),
                appointmentTitle : $('#appointmentTitle').val(),
                appointmentDescription : $('#appointmentDescription').val(),
                appointmentStatus : $('#appointmentStatus').val(),
                startTime : $('#startTime').val(),
                endTime : $('#endTime').val()
            };

            //console.log(appointment);
            var data = {
                _token : _token,
                appointment: appointment
            };

            if(appointment.appointmentId !== null){


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
                //console.log(data.appointment);
                if(data){
                    jQuery('#appointment_id').val(data.appointment.id);
                    jQuery('#appointmentTitle').val(data.appointment.title);
                    jQuery('#appointmentDescription').val(data.appointment.description);
                    jQuery('#appointmentStatus').val(data.appointment.status);
                    $('#aptCustomerId').val(data.appointment.customer_id);
                    $('#aptCustomerId').html("<option selected value='"+data.appointment.customer.id+"'>"+data.appointment.customer.first_name+', '+ data.appointment.customer.last_name+'@'+data.appointment.customer.company.name+"</option>");

                    min_date = moment(data.appointment.start_time);
                    max_date = moment(data.appointment.end_time);

                    updateDates();

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


            //datatable.ajax.reload(null, false);
            $("#appointments-list").dataTable().fnDestroy();
            jQuery('#appointments-list').DataTable({
//               responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-appointments-list', [$company->id]) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        }



        //updating task
        $('#task_modal_button').val('Add Task');
        $('#modal-new-task-label').text('Add A Task');
        $('#taskForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            //console.log('hello');
            var task = {
                taskId : $('#task_id').val(),
                taskCustomerId : $('#taskCustomerId').val(),
                taskTitle : $('#taskTitle').val(),
                taskDescription : $('#taskDescription').val(),
                taskDueDate : $('#taskDueDate').val(),
                taskStatus : $('#taskStatus').val(),
                taskPriority : $('#taskPriority').val(),

            };
            var data = {
                _token : _token,
                task: task
            };

            if(task.taskId !== null){
                //task editing.....

                var request = jQuery.ajax({
                    url: "{{ route('update.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        $('#taskForm')[0].reset();
                        $('#task_id').val('');
                        $('#task-modal').modal('hide');
                        get_all_task_data();
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

        function editTask(id){
            $('#task_modal_button').val('Update Task');
            $('#modal-new-task-label').text('Edit Task');

            $.get("{{ route('edit.task.data') }}", { id: id} ,function(data){
                if(data){
                    $('#task_id').val(data.task.id);
                    $('#taskCustomerId').val(data.task.customer_id);
                    $('#taskCustomerId').html("<option selected value='"+data.task.customer.id+"'>"+data.task.customer.first_name+', '+ data.task.customer.last_name+'@'+data.task.customer.company.name+"</option>");
                    $('#taskTitle').val(data.task.title);
                    $('#taskDescription').val(data.task.description);
                    //jQuery('#taskDueDate').datetimepicker('update', new Date(data.task.due_date));
                    jQuery('#taskDueDate').datetimepicker({date: new Date(data.task.due_date)});
                    $('#taskPriority').val(data.task.priority);
                    $('#taskStatus').val(data.task.status);

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
                                swal("Deleted!", "Company has been deleted.", "success");
                                get_all_task_data();
                                $.notify('Task deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the company", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Company is safe :)", "error");
                    }
                });
        }

        function get_all_task_data(){

            $("#tasks-list").dataTable().fnDestroy();
            var datatable = jQuery('#tasks-list').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-tasks-list', [$company->id]) !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title'},
                    { data: 'status', name: 'status' },
                    { data: 'due_date', name: 'due_date' },
                    { data: 'priority', name: 'priority' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        }



    </script>

@endsection