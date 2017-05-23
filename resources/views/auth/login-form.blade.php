
@section('login-form')
    <form class="login-form form-horizontal" role="form" method="POST" action="{{ route('login') }}" data-parsley-validate>
        {{ csrf_field() }}
        @if(!$errors->isEmpty())
            <p class="bg-danger  padding-sm">Invalid Credentials!</p>
        @endif
        <div class="form-group email {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="sr-only" for="login-email">Email or username</label>
            <span class="fa fa-user icon"></span>
            <input id="login-email"  data-parsley-trigger="change focusout" data-parsley-required-message="You must enter your email" type="email" required name="email" class="form-control login-email " placeholder="Email or username">

        </div>

        <div class="form-group password {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="sr-only" for="login-password">Password</label>
            <span class="fa fa-lock icon"></span>
            <input id="login-password" data-parsley-trigger="change focusout" name="password" data-parsley-required-message="You must enter your password" required type="password" class="form-control login-password" placeholder="Password">


            <p class="forgot-password"><a href="reset-password.html">Forgot password?</a></p>
        </div>

        <button type="submit" class="btn btn-block btn-primary">Login</button>
        <div class="checkbox remember">
            <label>
                <input type="checkbox"> Remember me
            </label>
        </div>

    </form>
@endsection

@section('after-footer-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
@endsection