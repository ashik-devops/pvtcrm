@section('user-group-create-form')
    <form method="post" class="ajax-from"  data-parsley-validate id="userGroupForm">

        {{ csrf_field() }}
        <input type="hidden" id="userGroup_id" name="userGroupId">

        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="sr-only">Name</label>
            <input id="userGroupName" type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name')}}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>



        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">

            <label class="sr-only">Members</label>
            <select name="userids[]" id="userIds" class="form-control" style="width: 100%" multiple="true" required data-parsley-trigger="change focusout" data-parsley-required-message="Please select at least one member">

            </select>
        </div>


<div class="form-group margin-top-md center-block text-center">
    <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
    <button type="submit" id="user_group_form_submit"  class="btn btn-success">Create</button>
</div>


        </div>

    </form>

@endsection



@section('user-group-new-member')
    <form method="post" class="ajax-from"  data-parsley-validate id="userGroupForm">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
            <label class="sr-only">User</label>
            <select name="userids[]" id="userIds" class="form-control" style="width: 100%" multiple="true" required data-parsley-trigger="change focusout" data-parsley-required-message="Please select at least one member">

            </select>
        </div>


        <div class="form-group margin-top-md center-block text-center">
            <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
            <button type="submit" id="sales_team_member_form_submit"  class="btn btn-success">Create</button>
        </div>
    </form>

@endsection




@section('group-form-scripts')
    <script type="text/javascript">
        var inputMap = {
            'userGroupId': 'userGroup_id',
            'userGroupName': 'userGroupName',
            'userIds': 'userIds'
        };


        var user_select=jQuery("#userIds").select2({
            placeholder: "Choose Members",
            ajax: {
                url: "{{route('get-user-options')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults : function (data){

                    return {
                        results: data.users
                    }
                },
                cache: true
            }
        });

        jQuery("#userGroupForm").submit(function (e) {
            e.preventDefault();
            if(!$(this).parsley().isValid()){
                return;
            }

            var _token = $('input[name="_token"]').val();
            var user_group = {
                userGroupId: jQuery('#' + inputMap.userGroupId).val(),
                userGroupName: jQuery('#' + inputMap.userGroupName).val(),
                userIds: jQuery('#' + inputMap.userIds).val()
            };


            var data = {
                _token: _token,
                userGroup: user_group
            };

            if (user_group.userGroupId === '') {


                var request = jQuery.ajax({
                    url: "{{ route('user-group-create') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {
                        jQuery("#user-group-modal").modal('hide');
                        get_all_user_groups();
                        $.notify(response.message, "success");
                    }
                    else {
                        jQuery.notify(response.message, "error");
                    }
                });

                request.error(function(xhr){
                    handle_error(xhr);
                });

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });

            } else {

                var request = jQuery.ajax({
                    url: "{{ route('user-group-update') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {

                        jQuery("#user-group-modal").modal('hide');
                        get_all_user_groups();
                        $.notify(response.message, "success");
                    }
                    else {
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
//            console.log(xhr);
            if(xhr.status==422){
                jQuery.map(xhr.responseJSON.errors, function (data, key) {
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
        /*Edit user group*/



    </script>

@endsection