@section('journal-create-form')
    <form method="post" data-parsley-validate class="ajax-from"  novalidate id="journalForm">

        {{ csrf_field() }}
        <input type="hidden" id="journal_id" name="journalId">
        <input type="hidden" id="origin_id" name="originId">

        <div class="form-group {{ $errors->has('journal-customer-id') ? ' has-error' : '' }}" id="journal-customer-id">
            <label class="sr-only">Customer</label>
            <select name="journal-customer-id" required data-parsley-trigger="change focusout" id="journalCustomerId" class="form-control" style="width: 100%">

            </select>
        </div>
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
            <label class="sr-only">Title</label>
            <input id="journalTitle" type="text" required data-parsley-trigger="change focusout" name="journal-title" class="form-control" placeholder="Journal Title" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required" required value="{{old('journal-title')}}">
            @if ($errors->has('journal-title'))
                <span class="help-block">
                    <strong>{{ $errors->first('journal-title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('journal-description') ? ' has-error' : '' }}" id="journal-description">
            <label class="sr-only">Description</label>
            <textarea  id="journalDescription" required data-parsley-trigger="change focusout"  type="text" name="journal-description" class="form-control" placeholder="Journal Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" required>{{old('journal-description')}}</textarea>
            @if ($errors->has('journal-description'))
                <span class="help-block">
                    <strong>{{ $errors->first('journal-description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('journal-log-date') ? ' has-error' : '' }}" id="journal-log-date">
            <label class="sr-only">Log Date</label>
            <div class="input-group date" id="logDateTimePicker">
                <input id="journalLogDate" type="text" required data-parsley-trigger="change focusout" name="journal-log-date" class="form-control" placeholder="Log Date" data-parsley-trigger="change focusout" data-parsley-required-message="Log Date is required" required value="{{old('journal-log-date')}}">

                <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
            </div>

            @if ($errors->has('journal-log-date'))
                <span class="help-block">
                <strong>{{ $errors->first('journal-log-date') }}</strong>
            </span>
            @endif
        </div>
        <div id="FollowupSection">
        <div class="form-group" id="followUpCheckboxId">
            Do you want to create follow up
            <input type="checkbox" id="followUpCheck" onClick="followUpTest()">

        </div>

        <!--hidden part for type-->


            <div id="typeItem">
                Type
                <input type="radio" id="taskFollowUp" name="followUpType" value="task"> Task
                <input  type="radio" id="appointmentFollowUp" name="followUpType" value="appointment"> Appointment
            </div>

            <!--hidden part for Task Form -->
            <div id="followUpTask" style="padding-top:20px">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
                    <label class="sr-only">Title</label>
                    <input data-parsley-trigger="change focusout" id="followupTaskTitle" type="text" name="title" class="form-control" placeholder="Title" >
                    @if ($errors->has('title'))
                        <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description">
                    <label class="sr-only">Description</label>
                    <textarea id="followupTaskDescription"  type="text" name="description" class="form-control" placeholder="Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" >{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('due-date') ? ' has-error' : '' }}" id="due-date">
                    <label class="sr-only">Date</label>
                    <div class="input-group date" id="followupTaskDueDateTimePicker">
                        <input id="followupTaskDueDate" type="text" name="due-date" class="form-control" placeholder="Due Date" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required"  value="{{old('due-date')}}">

                        <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                    </div>

                    @if ($errors->has('due-date'))
                        <span class="help-block">
                <strong>{{ $errors->first('due-date') }}</strong>
            </span>
                    @endif
                </div>



                <div class="form-group {{ $errors->has('priority') ? ' has-error' : '' }}" id="priority">
                    <label class="sr-only">Priority</label>
                    <select name="priority" id="followupTaskPriority" class="form-control">
                        <option>Low</option>
                        <option>Medium</option>
                        <option>Critical</option>
                        <option>High</option>
                    </select>
                </div>
            </div>


            <!--hidden part for Appointment Form-->
            <div id="followUpAppointment"  style="padding-top:20px">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
                    <label class="sr-only">Title</label>
                    <input id="followupAppointmentTitle" type="text" name="title" class="form-control" placeholder="Title" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required"  value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description">
                    <label class="sr-only">Description</label>
                    <textarea  id="followupAppointmentDescription"  type="text" name="description" class="form-control" placeholder="Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" >{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                    @endif
                </div>
                

                <div class="form-group {{ $errors->has('start_time') ? ' has-error' : '' }}" id="start_time">
                    <label class="sr-only">Date</label>
                    <div class="input-group date" id="followupAppointmentStartTimeContainer">
                        <input id="followupAppointmentStartTime" type="text" name="start_time" class="form-control" placeholder="Start Time" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required"  value="{{old('start_time')}}">

                        <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                    </div>

                    @if ($errors->has('start_time'))
                        <span class="help-block">
                    <strong>{{ $errors->first('start_time') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('end_time') ? ' has-error' : '' }}" id="end_time">
                    <label class="sr-only">Date</label>
                    <div class="input-group date" id="followupAppointmentEndTimeContainer">
                        <input id="followupAppointmentEndTime" type="text" name="end_time" class="form-control" placeholder="End Time" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required"  value="{{old('end_time')}}">

                        <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                    </div>

                    @if ($errors->has('end_time'))
                        <span class="help-block">
                    <strong>{{ $errors->first('end_time') }}</strong>
                </span>
                    @endif
                </div>
            </div>

        </div>





        <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
        <button type="button" class="btn btn-danger margin-top-md center-block" onclick="goBack()">Cancel</button>
        <input type="submit" id="journal_modal_button"  class="btn btn-success margin-top-md center-block" value="Add Journal">

    </form>
@endsection

@section('journal-create-form-script')
    <script>
        var journalInputMap={
            journalId : 'journal_id',
            originId: 'origin_id',
            journalCustomerId : 'journalCustomerId',
            journalTitle : 'journalTitle',
            journalDescription : 'journalDescription',
            journalLogDate : 'journalLogDate',

            followupTaskTitle : 'followupTaskTitle',
            followupTaskDescription : 'followupTaskDescription',
            followupTaskDueDate : 'followupTaskDueDate',
            followupTaskPriority : 'followupTaskPriority',

            followupAppointmentTitle : 'followupAppointmentTitle',
            followupAppointmentDescription : 'followupAppointmentDescription',
            followupAppointmentStartTime : 'followupAppointmentStartTime',
            followupAppointmentEndTime : 'followupAppointmentEndTime'
        };


        function formPrepare(){
            $('#typeItem').hide();
            $('#followUpTask').hide();
            $('#followUpAppointment').hide();
        }

        formPrepare();

            function followUpTest(){
                if($("#followUpCheck").prop('checked') == true) {
                    $('#typeItem').show();

                }else{
                    $("input[name=followUpType]:checked").prop('checked', false);
                    $('#typeItem').hide();
                    $('#followUpTask').hide();
                    $('#followUpAppointment').hide();
                    reset_followup_appointment_form();
                    reset_followup_task_form();
                }
            }

            $("input[name=followUpType]:radio").click(function () {
                if ($('input[name=followUpType]:checked').val() === "task") {
                    reset_followup_appointment_form();
                    $("#followupTaskTitle").attr('required', '');
                    $("#followupTaskDescription").attr('required', '');
                    $("#followupTaskDueDate").attr('required', '');
                    $('#followupTaskDueDateTimePicker').datetimepicker();
                    $('#followUpTask').show();
                    $('#followUpAppointment').hide();

                } else if ($('input[name=followUpType]:checked').val() === "appointment") {
                    reset_followup_task_form();
                    $("#followupAppointmentTitle").attr('required', 'true');
                    $("#followupAppointmentDescription").attr('required', 'true');
                    $("#followupAppointmentStartTime").attr('required', 'true');
                    $('#followupAppointmentEndTime').attr('required', 'true');
                    $('#followUpTask').hide();
                    $('#followUpAppointment').show();
                    $('#followupAppointmentStartTimeContainer').datetimepicker();
                    $('#followupAppointmentEndTimeContainer').datetimepicker();
                }
            });

            function reset_journal_form(el){
                el.reset();
                $('#'+journalInputMap.journalId).val('');
                reset_followup_task_form();
                reset_followup_appointment_form();
            }

            function reset_followup_appointment_form(){
                $("#followupAppointmentTitle").removeAttr('required');
                $("#followupAppointmentDescription").removeAttr('required');
                $("#followupAppointmentStartTime").removeAttr('required');
                $('#followupAppointmentEndTime').removeAttr('required');
                $('#'+journalInputMap.followupAppointmentTitle).val('');
                $('#f'+journalInputMap.followupAppointmentDescription).val('');
                $('#'+journalInputMap.followupAppointmentStartTime).val('');
                $('#'+journalInputMap.followupAppointmentEndTime).val('')
            }

        function reset_followup_task_form(){

            $("#followupTaskTitle").removeAttr('required');
            $("#followupTaskDescription").removeAttr('required');
            $("#followupTaskDueDate").removeAttr('required');
            $('#followupTaskDueDateTimePicker').datetimepicker();

            $('#'+journalInputMap.followupTaskTitle).val('');
            $('#'+journalInputMap.followupTaskDescription).val('');
            $('#'+journalInputMap.followupTaskDueDate).val('');
            $('#'+journalInputMap.followupTaskPriority).val('');
        }

        $('#journalLogDate').datetimepicker();




    </script>
@endsection
