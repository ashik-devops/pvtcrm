@section('sales-team-create-form')
    <form method="post" class="ajax-from"  data-parsley-validate id="salesTeamForm">

        {{ csrf_field() }}
        <input type="hidden" id="salesTeam_id">
        <div class="form-group {{ $errors->has('sales-team-name') ? ' has-error' : '' }}" id="sales-team-name">
            <label class="sr-only">Name</label>
            <input id="salesTeamName" type="text" name="sales-team-name" class="form-control" placeholder="Sales Team Name" data-parsley-trigger="change focusout" data-parsley-required-message="Sales Team Name is required"  value="{{old('sales-team-name')}}">
            @if ($errors->has('first-name'))
                <span class="help-block">
                    <strong id="firstNameMessge">{{ $errors->first('first-name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('sales-team-member') ? ' has-error' : '' }}" id="sales-team-member">
            <label class="sr-only">Customer</label>
            <select name="sales-team-member" id="userId" class="form-control" style="width: 100%">

            </select>
        </div>
        <div class="form-group {{ $errors->has('sales-team-note') ? ' has-error' : '' }}" id="sales-team-note">
            <label class="sr-only">Name</label>
            <textarea  id="salesTeamNote"  type="text" name="sales-team-note" class="form-control" placeholder="Sales Team Note" data-parsley-trigger="change focusout" >{{old('sales-team-note')}}</textarea>
            @if ($errors->has('sales-team-note'))
                <span class="help-block">
                    <strong id="firstNameMessge">{{ $errors->first('sales-team-note') }}</strong>
                </span>
            @endif
        </div>


        <input type="submit" id="modal_button"  class="btn btn-success margin-top-md center-block" value="Add Sales Team">

        </div>





    </form>
@endsection
