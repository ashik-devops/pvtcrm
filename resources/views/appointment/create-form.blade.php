@section('appointment-create-form')
    <form method="post" class="ajax-from"  data-parsley-validate id="appointmentForm">

        {{ csrf_field() }}
        <input type="hidden" id="appointment_id" name="appointmentId">
        <div class="form-group {{ $errors->has('customer-id') ? ' has-error' : '' }}" id="customer-id">
            <label class="sr-only">Customer</label>
            <select name="customer-id" id="aptCustomerId" class="form-control" style="width: 100%">

            </select>
        </div>
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
            <label class="sr-only">Title</label>
            <input id="appointmentTitle" type="text" name="title" class="form-control" placeholder="Title" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required" required value="{{old('title')}}">
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description">
            <label class="sr-only">Description</label>
            <textarea  id="appointmentDescription"  type="text" name="description" class="form-control" placeholder="Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" required>{{old('description')}}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}" id="status">
            <label class="sr-only">Status</label>
            <select name="status" id="appointmentStatus" class="form-control">
                <option>Due</option>
                <option>Done</option>
                <option>Cancelled</option>
            </select>
        </div>

        <div class="form-group {{ $errors->has('start_time') ? ' has-error' : '' }}" id="start_time">
            <label class="sr-only">Date</label>
            <div class="input-group date" id="start_timeTimePicker">
                <input id="startTime" type="text" name="start_time" class="form-control" placeholder="Start Time" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required" required value="{{old('start_time')}}">

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
            <div class="input-container" id="endtimeTimePickerContainer">
                <div class="input-group date" id="end_timeTimePicker">
                    <input id="endTime" type="text" name="end_time" class="form-control" placeholder="End Time" data-parsley-errors-container="#endtimeTimePickerContainer" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required" required value="{{old('end_time')}}">

                    <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                </div>

            </div>

            @if ($errors->has('end_time'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_time') }}</strong>
                </span>
            @endif
        </div>




        <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
        <input type="submit" id="appointment_modal_button"  class="btn btn-success margin-top-md center-block" value="Add Appointment">

        </div>

    </form>
@endsection
