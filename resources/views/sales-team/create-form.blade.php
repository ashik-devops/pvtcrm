@section('sales-team-create-form')
    <form method="post" class="ajax-from"  data-parsley-validate id="sales-teamForm">

        {{ csrf_field() }}
        <input type="hidden" id="sales-teamId" name="salesTeamId">

        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="sr-only">Name</label>
            <input id="sales-teamName" type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name')}}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
            <label class="sr-only">Manager</label>
            <select name="managerId" id="sales-teamManager" class="form-control" style="width: 100%"  required data-parsley-trigger="change focusout" data-parsley-required-message="Please select a manager">

            </select>
        </div>



        <div class="form-group {{ $errors->has('user-id') ? ' has-error' : '' }}" id="user-id">
            <label class="sr-only">User</label>
            <select name="userIds[]" id="sales-teamMembers" class="form-control select2-selection--multiple" multiple style="width: 100%"  required data-parsley-trigger="change focusout" data-parsley-required-message="Please select at least one member">

            </select>
        </div>


        <div class="form-group margin-top-md center-block text-center">
            <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
            <button type="submit" id="sales_team_form_submit"  class="btn btn-success">Create</button>
        </div>




    </form>

@endsection




{{--@section('modal-sales-team-new-name')--}}
    {{--<form method="post" class="ajax-from"  data-parsley-validate id="sales-teamForm">--}}
        {{--{{ csrf_field() }}--}}
        {{--<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">--}}
            {{--<label class="sr-only">Name</label>--}}
            {{--<input id="sales-teamName" type="text" name="name" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name')}}">--}}
            {{--@if ($errors->has('name'))--}}
                {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first('name') }}</strong>--}}
                {{--</span>--}}
            {{--@endif--}}
        {{--</div>--}}


        {{--<div class="form-group margin-top-md center-block text-center">--}}
            {{--<!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>-->--}}
            {{--<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>--}}
            {{--<button type="submit" id="sales_team_member_form_submit"  class="btn btn-success">Create</button>--}}
        {{--</div>--}}
    {{--</form>--}}

{{--@endsection--}}









@section('sales-team-form-scripts')
    <script type="text/javascript">
        var inputMap = {
            'salesTeamId': 'sales-teamId',
            'salesTeamName': 'sales-teamName',
            'salesTeamMembers': 'sales-teamMembers',
            'salesTeamManager': 'sales-teamManager'
        };






        var manager_select= jQuery("#sales-teamManager").select2({
            placeholder: "Choose Manager",
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

        jQuery("#sales-teamManager").change(function(){
            var members=  jQuery("#sales-teamMembers").val();
            if(members == null){
                return;
            }
            var index=members.indexOf(jQuery(this).val());
            if(index>-1){
              members.splice(index, 1);
            }
            console.log(members);
            jQuery("#sales-teamMembers").val(members).trigger('change');
        });

        var member_select=jQuery("#sales-teamMembers").select2({
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
                        results: jQuery.map(data.users, function(user){
                            if(jQuery("#sales-teamManager").val()==user.id){
                                return null;
                            }
                            return user;
                        })
                    }
                },
                cache: true
            }
        });


        jQuery("#sales-teamForm").submit(function (e) {
            e.preventDefault();
            if(!$(this).parsley().isValid()){
                return;
            }

            var _token = $('input[name="_token"]').val();
            var sales_team = {
                salesTeamId: jQuery('#' + inputMap.salesTeamId).val(),
                salesTeamName: jQuery('#' + inputMap.salesTeamName).val(),
                salesTeamManager:jQuery('#' +inputMap.salesTeamManager).val(),
                salesTeamMembers: jQuery('#' + inputMap.salesTeamMembers).val()
            };

            var data = {
                _token: _token,
                salesTeam: sales_team
            };

            if (sales_team.salesTeamId === '') {


                var request = jQuery.ajax({
                    url: "{{ route('create.sales.team') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {
                        jQuery("#sales-team-modal").modal('hide');
                        get_all_sales_team_data();
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
                    url: "{{ route('update.sales.team.data') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {

                        jQuery("#sales-team-modal").modal('hide');
                        get_all_sales_team_data();
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
            console.log(xhr);
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