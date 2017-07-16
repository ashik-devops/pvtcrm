@section('customer-create-form')
<form method="post" class="ajax-from"  data-parsley-validate id="customerForm">

        {{ csrf_field() }}
        <input type="hidden" id="customerId">
        <input type="hidden" id="addressId">
    <div class="form-group">
        <label class="sr-only">Choose Account</label>
        <select name="accountId" class="form-control" id="accountId" style="width: 100%"></select>

    </div>
    <div id="AccountDataAtCustomerForm">
        <div class="form-group">
            <label class="sr-only">Account No</label>
            <input id="accountNo" type="text" name="account-no" class="form-control" placeholder="Account No">
        </div>
        <div class="form-group">
            <label class="sr-only">Account Name</label>
            <input id="accountName" type="text" name="account-name" class="form-control" placeholder="Account Name">
        </div>
        <div class="form-group">
            <label class="sr-only">Account Website</label>
            <input  id="accountWebsite"  type="url" name="account-website" class="form-control" placeholder="Account Website">

        </div>
    </div>


        <div class="form-group {{ $errors->has('first-name') ? ' has-error' : '' }}" id="first-name">
            <label class="sr-only">First Name</label>
            <input id="firstName" type="text" name="first-name" class="form-control" placeholder="First Name" data-parsley-trigger="change focusout" data-parsley-required-message="First Name is required"  value="{{old('first-name')}}">
            @if ($errors->has('first-name'))
                <span class="help-block">
                    <strong id="firstNameMessge">{{ $errors->first('first-name') }}</strong>
                </span>
            @endif
        </div>
    <div class="form-group {{ $errors->has('last-name') ? ' has-error' : '' }}" id="last-name">
        <label class="sr-only">Last Name</label>
        <input  id="lastName"  type="text" name="last-name" class="form-control" placeholder="Last Name" data-parsley-trigger="change focusout" data-parsley-required-message="Last Name is required"  value="{{old('last-name')}}">
        @if ($errors->has('last-name'))
            <span class="help-block">
                    <strong>{{ $errors->first('last-name') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group"{{ $errors->has('customer-title') ? ' has-error' : '' }} id="customer-title">
        <input  id="customerTitle"  type="text" name="customer-title" class="form-control" placeholder="Customer Title" data-parsley-trigger="change focusout" data-parsley-required-message="Customer Title is required"  value="{{old('customer-title')}}">
        @if ($errors->has('customer-title'))
            <span class="help-block">
                <strong>{{ $errors->first('customer-title') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group {{ $errors->has('customer-email') ? ' has-error' : '' }}" id="customer-email">
        <label class="sr-only">Customer Email</label>
        <input  id="customerEmail"  type="email" name="customer-email" class="form-control" placeholder="Customer Email" data-parsley-trigger="change focusout" data-parsley-required-message="Customer Email is required"  value="{{old('customer-email')}}">
        @if ($errors->has('customer-email'))
            <span class="help-block">
                <strong>{{ $errors->first('customer-email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('customer-phone') ? ' has-error' : '' }}" id="customer-phone">
        <label class="sr-only">Customer Phone</label>
        <input  id="customerPhone"  type="text" name="customer-phone" class="form-control" placeholder="Customer Phone" data-parsley-trigger="change focusout" data-parsley-required-message="Customer Phone is required"  value="{{old('customer-phone')}}">
        @if ($errors->has('customer-phone'))
            <span class="help-block">
                    <strong>{{ $errors->first('customer-phone') }}</strong>
                </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('priority') ? ' has-error' : '' }}" id="priority">
        <label class="sr-only">Priority</label>
        <select name="priority" id="customerPriority" class="form-control" style="width: 100%">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
            <option value="Critical">Critical</option>
        </select>
    </div>

    <div class="form-group">
        <label class="sr-only">Choose User</label>
        <select name="userId" class="form-control" id="userId" style="width: 100%"></select>

    </div>



        <div class="form-group ">
            <label for="street_address" class="sr-only">Street Address</label>

            <div style="margin-bottom: 5px;">
                <input  id="streetAddress_1" type="text" placeholder="Steet Address" class="form-control" name="street_address_1" maxlength="128" >
            </div>
            <div style="margin-bottom: 5px;">
                <input id="streetAddress_2" type="text"  placeholder="Street Address" class="form-control"   >
            </div>

        </div>

        <div class="form-group">
            <label for="city" class="sr-only">City</label>
            <input id="city_id" type="text" class="form-control" placeholder="City"  name="city" >
        </div>

        <div class="form-group">
            <label for="state" class="sr-only">State</label>


            <input id="state_id" type="text" class="form-control" placeholder="State"  name="state" >


        </div>

        <div class="form-group"{{ $errors->has('state') ? ' has-error' : '' }} id="country">
            <label for="country" class="sr-only">Country</label>
            <input id="country_id" type="text" class="form-control" placeholder="Country"  name="country" >
        </div>

        <div class="form-group">
            <label for="zip" class="sr-only">ZIP</label>
            <input id="zip_id" type="text" class="form-control" placeholder="Zip" name="zip" >
        </div>

    <!--<button type="submit" class="btn btn-success margin-top-md center-block">Add Account</button>-->
    <input type="submit" id="modal_button"  class="btn btn-success margin-top-md center-block" value="Add Customer">

    </div>





    </form>
@endsection
