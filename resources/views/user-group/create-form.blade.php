@section('usergroup-create-form')
    <form method="post" class="ajax-from"  data-parsley-validate id="userGroupForm">

        {{ csrf_field() }}
        <input type="hidden" id="userGroup_id" name="userGroupId">

        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}" id="title">
            <label class="sr-only">Name</label>
            <input id="userGroupForm" type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Title is required" required value="{{old('title')}}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>



        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
            <label class="sr-only">Customer</label>
            <select name="userId" id="userId" class="form-control" style="width: 100%" multiple="true">

            </select>
        </div>



        <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
        <input type="submit" id="appointment_modal_button"  class="btn btn-success margin-top-md center-block" value="Add Appointment">

        </div>

    </form>
@endsection
