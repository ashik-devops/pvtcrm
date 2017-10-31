@section('role-form')
    <div class="col-sm-12 col-md-8 col-offset-2"></div>
    <form method="post" class="form-horizontal"  data-parsley-validate id="customerForm">

        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" id="name">
            <label class="sr-only">Role Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name" required class="form-control" placeholder="Role Name" data-parsley-trigger="change focusout" data-parsley-required-message="Role Name is required"  value="{{old('name', isset($role)?$role->name:'')}}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong id="firstNameMessge">{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
        <fieldset id="access_selectors" class="form-group">
            <div class="fieldset-title">Access Rules</div>
            @if($errors->has('access'))
                <div class="alert alert-theme alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Please set access rules
                </div>
            @endif
            @foreach(\App\Scope::all() as $scope)
                <div class="col-sm-6 col-lg-3 col-md-4 ">
                    <div class="scope">
                        <div class="title scope-box">{{$scope->label}} </div><br><br>
                        @foreach(\App\Action::all() as $action)
                            <div class="form-horizontal ">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{$action->label}} </label>
                                    <div class="col-sm-9">
                                        <input class="bootstrap-switch form-control switch-box" data-scope="{{$scope->label}}" data-action="{{$action->label}}" name="access[{{$scope->id}}][{{$action->id}}]"
                                               @if(isset(old("access", isset($access)?$access:[])[$scope->id][$action->id]))
                                               checked="checked"
                                               @endif
                                               data-on-text="Yes" type="checkbox"  value="true">

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </fieldset>
        <div class="text-center">
            <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>

        </div>

    </form>
@endsection

@section('role_form_styles')
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-switch.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/account.css')}}">


    <style type="text/css">
        .scope .title{
            font-weight: bold;
        }
        .scope{
            padding: 30px;
        }
        .fieldset-title{
            padding: 30px;
            margin-bottom: 30px;
            color: rgb(97, 102, 112);
            font-size: 16px;
            border-bottom: 1px solid rgb(234, 234, 241);
        }
    </style>
@endsection

@section('role_form_scripts')
    <script type="text/javascript" src="{{asset('storage/assets/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('storage/assets/js/bootstrap-switch.js')}}"></script>
    <script type="text/javascript" src="{{asset('storage/assets/js/forms-bootstrap-switch.js')}}"></script>
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-switch.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <script>
        function goBack() {
            window.history.back();
        }</script>
    <script>
           jQuery('input[type="checkbox"].bootstrap-switch').on('switchChange.bootstrapSwitch', function(event,state) {
//               if ($(this).is(':checked')) {
//                   if($(this).data("scope")   == "All" && $(this).data("action")   == "All" ){
//                       jQuery("input.bootstrap-switch[data-action='All']:not(input.bootstrap-switch[data-scope='All'][data-action='All'])").each(function () {
//                           jQuery(this).prop('checked', true).trigger('change');
//                           jQuery(this).bootstrapSwitch('disabled',true);
//
//                           })
//
////                       jQuery(this).bootstrapSwitch('disabled',false);
//switchChange.bootstrapSwitch
//
//                   }
//                   else { //if($(this).data("scope")=="Contact" && $(this).data("action")   == "All")
//                       $("input.bootstrap-switch[data-action='All'][data-action='All']")
//                       {
//
//                       }
//                   }
//
//                   }
//               if (!$(this).is(':checked')) {
//                   if($(this).data("scope")   == "All" && $(this).data("action")   == "All" ){
//                       jQuery("input.bootstrap-switch").each(function () {
//                           jQuery(this).removeAttr('checked',false).trigger('change');
//                           jQuery(this).bootstrapSwitch('disabled',false);
//
//                       })
//
//                   }
//
//               }
//
//
//
//

               var scope = $(this).data("scope");
               var action = $(this).data("action");
               if (jQuery(this).is(':checked')) {
                   var selector='';

                   if(action   === "All"){

                       if(scope==="All")
                        selector  = "input.bootstrap-switch[data-scope='"+scope+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"']), input.bootstrap-switch[data-action='"+action+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"'])";
                      else
                       selector  = "input.bootstrap-switch[data-scope='"+scope+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"'])";

                   }

                   else { //if($(this).data("scope")=="Contact" && $(this).data("action")   == "All")
                       if(scope === "All")
                            selector = "input.bootstrap-switch[data-action='"+action+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"'])";
                        else
                           selector = "";

                   }

                   if(selector.length > 0){
                       jQuery(selector).each(function () {
                           jQuery(this).prop('checked', true).trigger('change');
                           jQuery(this).bootstrapSwitch('disabled',true);

                       })
                   }


                   }
               if (!$(this).is(':checked')) {
                   var selector='';
                   if(action   === "All"){

                       if(scope==="All")
                           selector  = "input.bootstrap-switch[data-scope='"+scope+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"']), input.bootstrap-switch[data-action='"+action+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"'])";
                       else
                           selector  = "input.bootstrap-switch[data-scope='"+scope+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"'])";

                   }
                   else { //if($(this).data("scope")=="Contact" && $(this).data("action")   == "All")
                       if(scope === "All")
                           selector = "input.bootstrap-switch[data-action='"+action+"']:not(input.bootstrap-switch[data-scope='"+scope+"'][data-action='"+action+"'])";
                       else
                           selector = "";

                   }
                   if(selector.length > 0){
                       jQuery(selector).each(function () {
                           jQuery(this).prop('checked', false).trigger('change');
                           jQuery(this).bootstrapSwitch('disabled',false);

                       })
                   }

               }





           });
/*jQuery(":input").each(function () {
jQuery(this).attr('checked', 'checked').trigger('change');})
jQuery(":input").each(function () {
jQuery(this).removeAttr('checked').trigger('change');
})*/

    </script>
@endsection
