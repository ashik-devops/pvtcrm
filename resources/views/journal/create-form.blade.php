@section('journal-create-form')
    <form method="post" class="ajax-from"  novalidate id="journalForm">

        {{ csrf_field() }}
        <input type="hidden" id="journal_id" name="journalId">

        <div class="form-group {{ $errors->has('journal-customer-id') ? ' has-error' : '' }}" id="journal-customer-id">
            <label class="sr-only">Customer</label>
            <select name="journal-customer-id" id="journalCustomerId" class="form-control" style="width: 100%">

            </select>
        </div>
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
            <label class="sr-only">Title</label>
            <input id="journalTitle" type="text" name="journal-title" class="form-control" placeholder="Journal Title" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required" required value="{{old('journal-title')}}">
            @if ($errors->has('journal-title'))
                <span class="help-block">
                    <strong>{{ $errors->first('journal-title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('journal-description') ? ' has-error' : '' }}" id="journal-description">
            <label class="sr-only">Description</label>
            <textarea  id="journalDescription"  type="text" name="journal-description" class="form-control" placeholder="Journal Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" required>{{old('journal-description')}}</textarea>
            @if ($errors->has('journal-description'))
                <span class="help-block">
                    <strong>{{ $errors->first('journal-description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('journal-log-date') ? ' has-error' : '' }}" id="journal-log-date">
            <label class="sr-only">Log Date</label>
            <div class="input-group date" id="logDateTimePicker">
                <input id="journalLogDate" type="text" name="journal-log-date" class="form-control" placeholder="Log Date" data-parsley-trigger="change focusout" data-parsley-required-message="Log Date is required" required value="{{old('journal-log-date')}}">

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
                    <input required id="followupTaskTitle" type="text" name="title" class="form-control" placeholder="Title" >
                    @if ($errors->has('title'))
                        <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description">
                    <label class="sr-only">Description</label>
                    <textarea  id="followupTaskDescription"  type="text" name="description" class="form-control" placeholder="Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" required>{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('due-date') ? ' has-error' : '' }}" id="due-date">
                    <label class="sr-only">Date</label>
                    <div class="input-group date" id="followupTaskDueDateTimePicker">
                        <input id="followupTaskDueDate" type="text" name="due-date" class="form-control" placeholder="Due Date" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required" required value="{{old('due-date')}}">

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
                    <input id="followupAppointmentTitle" type="text" name="title" class="form-control" placeholder="Title" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required" required value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description">
                    <label class="sr-only">Description</label>
                    <textarea  id="followupAppointmentDescription"  type="text" name="description" class="form-control" placeholder="Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" required>{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                    @endif
                </div>
                

                <div class="form-group {{ $errors->has('start_time') ? ' has-error' : '' }}" id="start_time">
                    <label class="sr-only">Date</label>
                    <div class="input-group date" id="followupAppointmentStartTimeContainer">
                        <input id="followupAppointmentStartTime" type="text" name="start_time" class="form-control" placeholder="Start Time" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required" required value="{{old('start_time')}}">

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
                        <input id="followupAppointmentEndTime" type="text" name="end_time" class="form-control" placeholder="End Time" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required" required value="{{old('end_time')}}">

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
        <input type="submit" id="journal_modal_button"  class="btn btn-success margin-top-md center-block" value="Add Journal">

    </form>
@endsection
