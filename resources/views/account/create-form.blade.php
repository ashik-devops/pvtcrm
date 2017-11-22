@section('account-create-from')
    <form method="post" class="ajax-from"  data-parsley-validate id="accountForm">

        {{ csrf_field() }}
        <input type="hidden" id="account_id" name="accountId">
        <input type="hidden" id="address_id" name="addressId">
        <div class="form-group {{ $errors->has('account-no') ? ' has-error' : '' }}" id="account-no">
            <label class="sr-only">Account No</label>
            <input id="accountNo" type="text" name="account-no" class="form-control" placeholder="Account No" data-parsley-trigger="change focusout" data-parsley-required-message="Account No is required" required value="{{old('account-no')}}">
            @if ($errors->has('account-name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('account-no') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('account-name') ? ' has-error' : '' }}" id="account-name">
            <label class="sr-only">Account Name</label>
            <input id="accountName" type="text" name="account-name" class="form-control" placeholder="Account/Company Name" data-parsley-trigger="change focusout" data-parsley-required-message="Account Name is required" required value="{{old('account-name')}}">
            @if ($errors->has('account-name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('account-name') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('account-email') ? ' has-error' : '' }}" id="account-email">
            <label class="sr-only">Account Name</label>
            <input  id="accountEmail"  type="email" name="account-email" class="form-control" placeholder="Email" data-parsley-trigger="change focusout" data-parsley-required-message="Account Email is required" required value="{{old('account-email')}}">
            @if ($errors->has('account-email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('account-email') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('account-phone') ? ' has-error' : '' }}" id="account-phone">
            <label class="sr-only">Account Phone</label>
            <input  id="accountPhone"  type="text" name="account-phone" class="form-control" placeholder="Phone" data-parsley-trigger="change focusout" data-parsley-required-message="Account Phone is required" required value="{{old('account-phone')}}">
            @if ($errors->has('account-phone'))
                <span class="help-block">
                                        <strong>{{ $errors->first('account-phone') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('account-website') ? ' has-error' : '' }}" id="account-website">
            <label class="sr-only">Account Website</label>
            <input  id="accountWebsite"  type="url" name="account-website" class="form-control" placeholder="Website" value="{{old('account-website')}}">
            @if ($errors->has('account-website'))
                <span class="help-block">
                                        <strong>{{ $errors->first('account-website') }}</strong>
                                    </span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('street_address_1') || $errors->has('street_address_2')   ? ' has-error' : '' }}" id="street_address">
            <label for="street_address" class="sr-only">Street Address</label>


            <div style="margin-bottom: 5px;">
                <input  id="streetAddress_1" type="text" placeholder="Steet Address" class="form-control" data-parsley-trigger="change focusout" value="{{ old('street_address_1') }}" name="street_address_1" maxlength="128" required data-parsley-required-message="Please enter Address">
                @if ($errors->has('street_address_1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('street_address_1') }}</strong>
                    </span>
                @endif
            </div>
            <div style="margin-bottom: 5px;">
                <input id="streetAddress_2" type="text"  placeholder="Steet Address" class="form-control"  data-parsley-trigger="change focusout" value="{{ old('street_address_2') }}" name="street_address_2" maxlength="128" >
                @if ($errors->has('street_address_2'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('street_address_2') }}</strong>
                                            </span>
                @endif
            </div>

        </div>

        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}" id="city">
            <label for="city" class="sr-only">City</label>


            <input id="city_id" type="text" class="form-control" placeholder="City" value="{{ old('city') }}" name="city" maxlength="32" required data-parsley-trigger="change focusout" required data-parsley-required-message="You must enter city " >
            @if ($errors->has('city'))
                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
            @endif

        </div>
        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="state">
            <label for="state" class="sr-only">State</label>


            <input id="state_id" type="text" class="form-control" placeholder="State" value="{{ old('state') }}" name="state" maxlength="32" required required data-parsley-required-message = "You must enter state" data-parsley-trigger="change focusout">
            @if ($errors->has('state'))
                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
            @endif

        </div>

        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="country">
            <label for="country" class="sr-only">Country</label>


            <input id="country_id" type="text" class="form-control" placeholder="Country" value="{{ old('country') }}" name="country" maxlength="32" required required data-parsley-required-message = "You must enter country" data-parsley-trigger="change focusout">
            @if ($errors->has('country'))
                <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
            @endif

        </div>
        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="zip">
            <label for="zip" class="sr-only">ZIP</label>


            <input id="zip_id" type="text" class="form-control" placeholder="Zip" value="{{ old('zip') }}" name="zip" maxlength="8" required required data-parsley-required-message = "You must enter ZIP Code" data-parsley-trigger="change focusout">
            @if ($errors->has('zip'))
                <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
            @endif
        </div>

        <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Account</button>-->
        <button type="button" class="btn btn-danger margin-top-md center-block" onclick="goBack()">Cancel</button>
        <input type="submit" id="modal_button"  class="btn btn-success margin-top-md center-block" value="Add Account">

    </form>
@endsection
