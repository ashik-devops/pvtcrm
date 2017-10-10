@section('usergroup-create-form')
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
            <label class="sr-only">User</label>
            <select name="userids[]" id="userIds" class="form-control" style="width: 100%" multiple="true">
                @foreach(\Illuminate\Support\Facades\Auth::user()->getSubordinates() as $user)
                    @php
                    $user=\App\User::find($user)
                    @endphp
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>




        <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Cancel">Cancel</button>
        <button type="submit" id="user_group_form_submit"  class="btn btn-success margin-top-md center-block">Create</button>

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
        var userSelect = jQuery("#userIds").select2({
            placeholder: "Choose Member Users",
            allowClear: true
        });

        function createNewUserGroup() {
            jQuery("#usergroup-modal #modal-new-usergroup-label.modal-title").html("Add New User Group");
            jQuery("#usergroup-modal #user_group_form_submit").html("Create");

            jQuery("#usergroup-modal").show();

        }



        jQuery("#userGroupForm").submit(function (e) {
            e.preventDefault();
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
                //account creating.....


                var request = jQuery.ajax({
                    url: "{{ route('user-group-create') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {
                        reset_form($('#userGroupForm')[0]);
                        jQuery("#usergroup-modal").hide();
                        get_all_user_groups();
                        $.notify(response.message, "success");
                    }
                    else {
                        jQuery.notify(response.message, "error");
                    }
                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            } else {
                //account editing.....

                var request = jQuery.ajax({
                    url: "{{ route('user-group-update') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {
                        reset_form($('#userGroupForm')[0]);

                        jQuery("#usergroup-modal").hide();
                        get_all_user_groups();
                        $.notify(response.message, "success");
                    }
                    else {
                        jQuery.notify(response.message, "error");
                    }
                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });

            }
        });

        function reset_form(el) {
            el.reset();
            jQuery("#userIds").val('').trigger('change');
        }

        /*Edit user group*/

        function editUserGroup(id){

            jQuery.ajax({
                url: "{{route('single-user-group.data')}}"
            });

            jQuery("#usergroup-modal #modal-new-usergroup-label.modal-title").html("Add New User Group");
            jQuery("#usergroup-modal #user_group_form_submit").html("Create");


            jQuery("#userIds").select2({
                placeholder: "Choose Member Users",
                allowClear: true
            });

            jQuery("#usergroup-modal").show();
        }


    </script>

@endsection