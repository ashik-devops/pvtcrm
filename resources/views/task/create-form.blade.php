@section('task-create-form')
<form method="post" class="ajax-from"  data-parsley-validate id="taskForm">

    {{ csrf_field() }}
    <input type="hidden" id="task_id" name="taskId">
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
        <label class="sr-only">Title</label>
        <input id="taskTitle" type="text" name="title" class="form-control" placeholder="Title" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required" required value="{{old('title')}}">
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('customer-id') ? ' has-error' : '' }}" id="customer-id">
        <label class="sr-only">Customer</label>
        <select name="customer-id" id="taskCustomerId" class="form-control" style="width: 100%">

        </select>
    </div>
    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description">
        <label class="sr-only">Description</label>
        <textarea  id="taskDescription"  type="text" name="description" class="form-control" placeholder="Description" data-parsley-trigger="change focusout" data-parsley-required-message="Description  is required" required>{{old('description')}}</textarea>
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('due-date') ? ' has-error' : '' }}" id="due-date">
        <label class="sr-only">Date</label>
        <div class="input-group date" id="taskDueDateTimePicker">
            <input id="taskDueDate" type="text" name="due-date" class="form-control" placeholder="Due Date" data-parsley-trigger="change focusout" data-parsley-required-message="Due Date is required" required value="{{old('due-date')}}">

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
        <select name="priority" id="taskPriority" class="form-control">
            <option>Low</option>
            <option>Medium</option>
            <option>Critical</option>
            <option>High</option>
        </select>
    </div>

    <div class="form-group margin-top-md center-block text-center">
        <input type="submit" id="task_modal_button"  class="btn btn-success " value="Add Task">
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>

    </div>
    </form>
@endsection
