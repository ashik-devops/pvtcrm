@include('layouts.copyright')
@section('footer')
<footer id="footer" class="site-footer">
    @yield('copyright')
    <div class="text-center">{{config('app.version')}}</div>
</footer>
@endsection

