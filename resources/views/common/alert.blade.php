

    <div class="alert {{ Session::get('message_class') }} alert-theme alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ Session::get('message') }}
    </div>
