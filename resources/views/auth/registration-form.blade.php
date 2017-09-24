@section('registration-form')
    <form method="post" role="form" id="registration-form" action="{{ route('register') }}" data-parsley-validate id="userForm">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" >
            <label class="sr-only">Name</label>
            <input type="text" name="name" id="userName" class="form-control" placeholder="Name" data-parsley-trigger="change focusout" data-parsley-required-message="Name is required" required value="{{old('name')}}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="sr-only">Email</label>
            <input type="email" name="email" id="userEmail" class="form-control" placeholder="Enter Email Address" required data-parsley-trigger="change focusout" value="{{ old('email') }}" data-parsley-required-message="You must enter email">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('initial') ? ' has-error' : '' }}">
            <label class="sr-only">Initial</label>
            <input type="text" name="initial" id="userInitial" class="form-control" placeholder="Initial" required data-parsley-trigger="change focusout" value="{{ old('initial') }}" data-parsley-required-message="You must enter initial.">
            @if ($errors->has('initial'))
                <span class="help-block">
                    <strong>{{ $errors->first('initial') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
            <label class="sr-only">Role</label>
            <select name="role" style="width:100%"  id="userRole"  class="form-control" data-parsley-trigger="change" required value="{{ old('role') }}" data-parsley-required-message="You must select a role.">
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="sr-only">Password</label>
            <input type="password" name="password" minlength="6"  id="userPassword"   class="form-control" id="password" placeholder="Enter Password" required data-parsley-trigger="change focusout" data-parsley-required-message="You must enter a password.">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="sr-only">Confirm Password</label>
            <input type="password" name="password_confirmation" minlength="6" id="userPasswordConfirmation"  class="form-control" placeholder="Enter Password Again" required data-parsley-trigger="change focusout" data-parsley-equalto="#userPassword" data-parsley-equalto-message="Passwords does not match" data-parsley-required-message="You must enter password again.">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('primary_phone_no') ? ' has-error' : '' }}">
            <label class="sr-only">Primary Phone</label>
            <input type="text" name="primary_phone_no"  id="userPrimaryPhone"  class="form-control" placeholder="Primary Phone " required data-parsley-trigger="change focusout" value="{{ old('primary_phone_no') }}" data-parsley-required-message="You must enter phone no.">
            @if ($errors->has('primary_phone_no'))
                <span class="help-block">
                    <strong>{{ $errors->first('primary_phone_no') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('secondary_phone_no') ? ' has-error' : '' }}">
            <label class="sr-only">Secondary Phone</label>
            <input type="text" name="secondary_phone_no"   id="userSecondaryPhone"  class="form-control" placeholder="Secondary Phone " data-parsley-trigger="change focusout" value="{{ old('secondary_phone_no') }}">
            @if ($errors->has('secondary_phone_no'))
                <span class="help-block">
                    <strong>{{ $errors->first('secondary_phone_no') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('street_address_1') || $errors->has('street_address_2')   ? ' has-error' : '' }}">
            <label for="street_address" class="sr-only">Street Address</label>


            <div style="margin-bottom: 5px;">
                <input  type="text"   id="userStreetAddress_1"  placeholder="Steet Address" class="form-control" data-parsley-trigger="change focusout" value="{{ old('street_address_1') }}" name="street_address_1" maxlength="128" required data-parsley-required-message="Please enter Address">
                @if ($errors->has('street_address_1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('street_address_1') }}</strong>
                    </span>
                @endif
            </div>
            <div style="margin-bottom: 5px;">
                <input  type="text"   id="userStreetAddress_2"   placeholder="Steet Address" class="form-control"  data-parsley-trigger="change focusout" value="{{ old('street_address_2') }}" name="street_address_2" maxlength="128" >
                @if ($errors->has('street_address_2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('street_address_2') }}</strong>
                    </span>
                @endif
            </div>

        </div>

        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
            <label for="city" class="sr-only">City</label>


            <input  type="text" class="form-control"   id="userCity"  placeholder="City" value="{{ old('city') }}" name="city" maxlength="32" required data-parsley-trigger="change focusout" required data-parsley-required-message="You must enter city required data-parsley-required-message = "" >
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif

        </div>
        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }}>
            <label for="state" class="sr-only">State</label>


            <input  type="text" class="form-control"   id="userState"  placeholder="State" value="{{ old('state') }}" name="state" maxlength="32" required required data-parsley-required-message = "You must enter state" data-parsley-trigger="change focusout">
            @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group"{{ $errors->has('country') ? ' has-error' : '' }}>
            <label for="country" class="sr-only">Country</label>


            <input  type="text" class="form-control"   id="userCountry"  placeholder="Country" value="{{ old('country') }}" name="country" maxlength="32" required  data-parsley-required-message = "You must enter country" data-parsley-trigger="change focusout">
            @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif

        </div>
        <div class="form-group"{{ $errors->has('zip') ? ' has-error' : '' }}>
            <label for="zip" class="sr-only">ZIP</label>


            <input id="userZip" type="text" class="form-control" placeholder="Zip" value="{{ old('zip') }}" name="zip" maxlength="8"  required data-parsley-required-message = "You must enter ZIP Code" data-parsley-trigger="change focusout">
            @if ($errors->has('zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group"{{ $errors->has('status') ? ' has-error' : '' }}>
            <label for="status" class="sr-only">Status</label>

            <select name="status" class="form-control" id="userStatus" required value="{{old('status')}}" style="width:100%" >
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>

            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group"{{ $errors->has('timezone') ? ' has-error' : '' }}>
            <label for="timezone" class="sr-only">Timezone</label>

            <select name="timezone" class="form-control" id="userTimezone" required value="{{old('timezone')}}" style="width:100%">
                <option value="{{old('timezone', 161)}}">{{\App\Timezone::find(old('timezone', '161'))->getLabel()}}</option>
            </select>

            @if ($errors->has('timezone'))
                <span class="help-block">
                    <strong>{{ $errors->first('timezone') }}</strong>
                </span>
            @endif
        </div>


        <button type="submit" class="btn btn-success margin-top-md center-block">Add User</button>

    </form>
@endsection

@section('registration-form-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script type="text/javascript">
        jQuery("#userStatus").select2();
        jQuery("#userRole").select2({
            placeholder: "Select Role"
        });
        jQuery("#userTimezone").select2({
            ajax: {
                url: "{{route('timezones')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term

                    };
                },
                processResults : function (data){

                    return {
                        results: data.timezones
                    }
                },

                cache: true
            }
        });

        var inputMap = {
            'name': 'userName',
            'email': 'userEmail',
            'initial': 'userInitial',
            'role': 'userRole',
            'password': 'userPassword',
            'password_confirmation': 'userPasswordConfirmation',
            'primary_phone_no': 'userPrimaryPhone',
            'secondary_phone_no': 'userSecondaryPhone',
            'street_address_1': 'userStreetAddress_1',
            'street_address_2': 'userStreetAddress_2',
            'state': 'userState',
            'city': 'userCity',
            'country': 'userCountry',
            'zip': 'userZip',
            'status': 'userStatus',
            'timezone': 'userTimezone',
        }


    </script>
@endsection

