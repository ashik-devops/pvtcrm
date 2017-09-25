@section('role-create-form')
    <div class="col-sm-12 col-md-8 col-offset-2"></div>
    <form method="post" class="form-horizontal"  data-parsley-validate id="customerForm">

        {{ csrf_field() }}
        <input type="hidden" id="role_id">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" id="name">
            <label class="sr-only">Role Name</label>
            <div class="col-sm-9">
                <input id="name" type="text" name="name" class="form-control" placeholder="Role Name" data-parsley-trigger="change focusout" data-parsley-required-message="Role Name is required"  value="{{old('name')}}">
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
            @foreach($policy_structure as $policy=>$actions)
                <div class="scope">
                <div class="title">{{mb_convert_case($policy, MB_CASE_TITLE)}} </div>
                @foreach($actions as $action)
                <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{mb_convert_case($action, MB_CASE_TITLE)}}</label>
                            <div class="col-sm-9">
                                <input class="bootstrap-switch form-control" name="access[ {{$policy}} ][ {{$action}} ]" data-on-text="Yes" type="checkbox" value="true">
                            </div>
                        </div>
                    </div>
                    @endforeach
        </div>
            @endforeach
        </fieldset>

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
    <script src="{{asset('storage/assets/js/bootstrap-switch.js')}}"></script>
    <script src="{{asset('storage/assets/js/forms-bootstrap-switch.js')}}"></script>
@endsection
