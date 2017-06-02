@section('customer-create-from')
    <form method="post" class="ajax-from" role="form" action="{{ route('create-company') }}" data-parsley-validate>
        {{ csrf_field() }}

        <div class="form-group {{ $errors->has('company-name') ? ' has-error' : '' }}" id="company-name">
            <label class="sr-only">Company Name</label>
            <input type="text" name="company-name" class="form-control" placeholder="Comapny Name" data-parsley-trigger="change focusout" data-parsley-required-message="Company Name is required" required value="{{old('company-name')}}">
            @if ($errors->has('company-name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company-name') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('company-email') ? ' has-error' : '' }}" id="company-email">
            <label class="sr-only">Company Name</label>
            <input type="email" name="company-email" class="form-control" placeholder="Comapny Email" data-parsley-trigger="change focusout" data-parsley-required-message="Company Email is required" required value="{{old('company-email')}}">
            @if ($errors->has('company-email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company-email') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('company-phone') ? ' has-error' : '' }}" id="company-phone">
            <label class="sr-only">Company Phone</label>
            <input type="text" name="company-phone" class="form-control" placeholder="Comapny Phone" data-parsley-trigger="change focusout" data-parsley-required-message="Company Phone is required" required value="{{old('company-phone')}}">
            @if ($errors->has('company-phone'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company-phone') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('company-website') ? ' has-error' : '' }}" id="company-website">
            <label class="sr-only">Company Website</label>
            <input type="url" name="company-website" class="form-control" placeholder="Comapny Website" value="{{old('company-website')}}">
            @if ($errors->has('company-website'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company-website') }}</strong>
                                    </span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('street_address_1') || $errors->has('street_address_2')   ? ' has-error' : '' }}" id="street_address">
            <label for="street_address" class="sr-only">Street Address</label>


            <div style="margin-bottom: 5px;">
                <input id="street_address_1" type="text" placeholder="Steet Address" class="form-control" data-parsley-trigger="change focusout" value="{{ old('street_address_1') }}" name="street_address_1" maxlength="128" required data-parsley-required-message="Please enter Address">
                @if ($errors->has('street_address_1'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('street_address_1') }}</strong>
                                    </span>
                @endif
            </div>
            <div style="margin-bottom: 5px;">
                <input id="street_address_2" type="text"  placeholder="Steet Address" class="form-control"  data-parsley-trigger="change focusout" value="{{ old('street_address_2') }}" name="street_address_2" maxlength="128" >
                @if ($errors->has('street_address_2'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('street_address_2') }}</strong>
                                            </span>
                @endif
            </div>

        </div>

        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}" id="city">
            <label for="city" class="sr-only">City</label>


            <input id="city" type="text" class="form-control" placeholder="City" value="{{ old('city') }}" name="city" maxlength="32" required data-parsley-trigger="change focusout" required data-parsley-required-message="You must enter city required data-parsley-required-message = "" >
            @if ($errors->has('city'))
                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
            @endif

        </div>
        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="state">
            <label for="state" class="sr-only">State</label>


            <input id="state" type="text" class="form-control" placeholder="State" value="{{ old('state') }}" name="state" maxlength="32" required required data-parsley-required-message = "You must enter state" data-parsley-trigger="change focusout">
            @if ($errors->has('state'))
                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
            @endif

        </div>

        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="country">
            <label for="country" class="sr-only">Country</label>


            <input id="country" type="text" class="form-control" placeholder="Country" value="{{ old('country') }}" name="country" maxlength="32" required required data-parsley-required-message = "You must enter country" data-parsley-trigger="change focusout">
            @if ($errors->has('country'))
                <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
            @endif

        </div>
        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="zip">
            <label for="zip" class="sr-only">ZIP</label>


            <input id="zip" type="text" class="form-control" placeholder="Zip" value="{{ old('zip') }}" name="zip" maxlength="8" required required data-parsley-required-message = "You must enter ZIP Code" data-parsley-trigger="change focusout">
            @if ($errors->has('zip'))
                <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
            @endif
        </div>

        <button type="submit" class="btn btn-success margin-top-md center-block">Add Company</button>

    </form>
@endsection
