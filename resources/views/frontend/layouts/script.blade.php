<!--Start of Tawk.to Script-->
@if ($contact)
    {!! $contact->code_footer !!}
@endif
<script src="{{ url('js/jquery.min.js') }}"></script>

<script src="{{ url('js/popper.min.js') }}"></script>

<script src="{{ url('js/bootstrap.min.js') }}"></script>

<script src="{{ url('js/confer.bundle.js') }}"></script>
<script src="{{ url('js/default-assets/active.js') }}"></script>
<script src="{{ url('js/slider.js') }}"></script>
<script src="{{ url('js/slick.js') }}"></script>
<script src="{{ url('js/swiper.min.js') }}"></script>

@yield('scripts')
