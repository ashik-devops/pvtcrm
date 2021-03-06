@extends('layouts.app')
@include('task.create-form')
@include('task.task-view')
@include('journal.create-form')
@include('account.create-form')
@include('appointment.create-form')
@include('task.create-form')
@include('journal.create-form')
@include('customer.create-form')
@include('appointment.appointment-view')
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
            <h2 class="view-title">Tasks</h2>
            @can('create', \App\Task::class)
            <div class="actions">
                <button id="new-task-btn" class="btn btn-success" data-toggle="modal" data-target="#task-modal"><i class="fa fa-plus"></i> New Task</button>
            </div>
            @endcan
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">Tasks</h3>--}}

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
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <!-- Modal for creating customer -->
    <div class="modal customerModal" id="task-modal" role="dialog" aria-labelledby="task-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="viewTask(id)" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        var inputMap={
            taskId : 'task_id',
            taskCustomerId : 'taskCustomerId',
            taskTitle : 'taskTitle',
            taskDescription : 'taskDescription',
            taskDueDate : 'taskDueDate',
            taskStatus : 'taskStatus',
            taskPriority : 'taskPriority',
        };

        var task_date=moment();
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                paging:true,
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                ajax: '{!! route('task-data') !!}',
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

           var task_customer_select= jQuery("#taskCustomerId").select2({
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

                        return {
                            results: data.customers
                        }
                    },

                    cache: true
                }
            });
            jQuery('.modal').on('shown.bs.modal', function () {
                    $('#taskDueDateTimePicker').datetimepicker();
                updateDates();
            });

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

        }
        jQuery("button#new-task-btn").click(function () {

            reset_form('taskForm');
//                console.log($('#'+inputMap.taskId).val() != '');
//               if($('#'+inputMap.taskId).val() != ''){
//                   reset_form($("#taskForm")[0]);
//               }
            });

        function updateDates(){
            $('#taskDueDateTimePicker').data("DateTimePicker").date(task_date);
        }



        //creating task
        $('#task_modal_button').val('Add Task');
        $('#modal-new-task-label').text('Add A Task');
        $('#taskForm').on('submit',function(e){
            e.preventDefault();
            if(!$(this).parsley().isValid()){
                return;
            }
            var _token = $('input[name="_token"]').val();
            //console.log('hello');
            var task = {
                taskId : $('#'+inputMap.taskId).val(),
                taskCustomerId : $('#'+inputMap.taskCustomerId).val(),
                taskTitle : $('#'+inputMap.taskTitle).val(),
                taskDescription : $('#'+inputMap.taskDescription).val(),
                taskDueDate : $('#'+inputMap.taskDueDate).val(),
                taskStatus : $('#'+inputMap.taskStatus).val(),
                taskPriority : $('#'+inputMap.taskPriority).val(),

            };
            var data = {
                _token : _token,
                task: task
            };

            if(task.taskId === ''){
                //task creating.....

                var request = jQuery.ajax({
                    url: "{{ route('create.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#taskForm')[0]);
                        $('#task-modal').modal('hide');
                        get_all_task_data();
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
                    $.notify(textStatus, "error");
                });
            } else{
                //task editing.....

                var request = jQuery.ajax({
                    url: "{{ route('update.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#taskForm')[0]);
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
                    handle_error(xhr);
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

        jQuery('.modal').on('shown.bs.modal', function () {


            $('#taskDueDate').datetimepicker({date : task_date});


        });
        function editTask(id){
            $('#task_modal_button').val('Update Task');
            $('#modal-new-task-label').text('Edit Task');

            $.get("{{ route('edit.task.data') }}", { id: id} ,function(data){
                console.log(data.task);
                if(data){
                    $('#task_id').val(data.task.id);
                    $('#taskCustomerId').val(data.task.customer_id);
                    $('#taskCustomerId').html("<option selected value='"+data.task.customer.id+"'>"+data.task.customer.first_name+', '+ data.task.customer.last_name+'@'+data.task.customer.account.name+"</option>");
                    $('#taskTitle').val(data.task.title);
                    $('#taskDescription').val(data.task.description);
                    task_date = moment(data.task.due_date);
                    $('#taskPriority').val(data.task.priority);
                    $('#taskStatus').val(data.task.status);
                    updateDates();
                }

            });

            $('#task-modal').modal('show');
        }

        function closeTask(id, status){

            $('#journal_modal_button').val(status+ ' Task');
            $('#modal-complete-task-label').val(status+ ' Task');
            if(status=='Complete'){
                status='Done';
            }
            else if(status=='Cancel'){
                status = 'Cancelled';
            }

            $('#origin_id').val(id);
            $('#journal-customer-id').remove();

            $('#task-modal-complete').modal('show');
            $('#journalForm').on('submit',function(e) {
                e.preventDefault();
                if(!$(this).parsley().isValid()){
                    return;
                }
                var _token = $('input[name="_token"]').val();

                var journal = {
                    originId : $('#'+journalInputMap.originId).val(),
                    journalTitle : $('#'+journalInputMap.journalTitle).val(),
                    journalDescription : $('#'+journalInputMap.journalDescription).val(),
                    journalLogDate : $('#'+journalInputMap.journalLogDate).val(),
                };

                if($('input[name=followUpType]:checked').val() === 'appointment')
                {
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
                    url: "{{ route('close.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {

                    if(response.result == 'Saved'){
                        reset_journal_form($('#journalForm')[0]);
                        $('#task-modal-complete').modal('hide');
                        get_all_task_data();
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


        {{--function deleteTask(id){--}}
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


                        {{--$.post("{{ route('delete.task') }}", data, function(result){--}}

                            {{--if(result.result == 'Success'){--}}
                                {{--swal("Deleted!", "Task has been deleted.", "success");--}}
                                {{--get_all_task_data();--}}
                                {{--$.notify('Task deleted successfully', "danger");--}}
                            {{--}--}}
                            {{--else{--}}
                                {{--swal("Failed", "Failed to delete the account", "error");--}}
                            {{--}--}}

                        {{--});--}}
                    {{--} else {--}}
                        {{--swal("Cancelled", "Account is safe :)", "error");--}}
                    {{--}--}}
                {{--});--}}
        {{--}--}}



        function get_all_task_data(){
            datatable.ajax.reload(null, false);
        }

        function viewTask(id){
            $.get("{{ route('edit.task.data') }}", { id: id} ,function(data){
                //console.log(data.task);
                if(data){
                    $('#task_id').val(data.task.id);
                    $('#viewTaskCustomer').html(data.task.customer.first_name+', '+ data.task.customer.last_name+'@'+data.task.customer.account.name);

                    $('#viewTaskTitle').html(data.task.title);
                    $('#viewTaskDescription').html(data.task.description);
                    $('#viewTaskDeadline').html(data.task.due_date);

                    //task_date = moment(data.task.due_date);
                    $('#viewTaskPriority').html(data.task.priority);
                    $('#viewTaskStatus').html(data.task.status);
                    if(data.task.status == "Done" || data.task.status == "Complete"||data.task.status == "Cancel" || data.task.status == "Cancelled"){
                        $("#complete-task-button").hide();
                        $("#cancel-task-button").hide();
                        $("#edit-task-button").hide();

                    }
                    else {
                        $("#complete-task-button").show();
                        $("#cancel-task-button").show();
                        $("#edit-task-button").show();

                    }
                    //updateDates();
                    //var id = data.task.id;
                    //console.log(id);

                }

            });

            $('#task-modal-view').modal('show');
            $('#taskIdForView').val(id);




        }

        function editTaskWithClosingView(){
            var id = $('#taskIdForView').val();

            $('#task-modal-view').modal('hide');


            editTask(id);

        }

        function completeTaskWithClosingView(){
            var id = $('#taskIdForView').val();

            $('#task-modal-view').modal('hide');


            closeTask(id, 'Complete');

        }
        function cancelTaskWithClosingView(id){
            var id = $('#taskIdForView').val();

            $('#task-modal-view').modal('hide');


            closeTask(id, 'Cancel');

        }

        function cancelTask(id) {
            $('#task-modal-view').modal('hide');


            closeTask(id, 'Cancel');
        }



    </script>




@endsection