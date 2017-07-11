@section('tag-create-form')
<form method="post" class="ajax-from"  data-parsley-validate id="tagForm">

    {{ csrf_field() }}
    <input type="hidden" id="tag_id" name="tagId">
    <div class="form-group {{ $errors->has('tag-name') ? ' has-error' : '' }}" id="tag-name">
        <label class="sr-only">Title</label>
        <input id="tagName" type="text" name="tag-name" class="form-control" placeholder="Title" data-parsley-trigger="change focusout" data-parsley-required-message="Tag Name is required" required value="{{old('tag-name')}}">
        @if ($errors->has('tag-name'))
            <span class="help-block">
                <strong>{{ $errors->first('tag-name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('customer-id') ? ' has-error' : '' }}" id="customer-id">
        <label class="sr-only">Customer</label>
        <select name="customer-id" id="tagCustomerId" class="form-control" style="width: 100%">

        </select>
    </div>


    <input type="submit" id="tag_modal_button"  class="btn btn-success margin-top-md center-block" value="Add Tag">

    </div>





    </form>
@endsection
