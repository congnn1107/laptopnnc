<!DOCTYPE html>
<html lang="en">

<head>
    @section('headdoc')
        @include('shop.layout.headdoc')
    @show
</head>

<body>
    {{-- cart --}}
    @include('shop.layout.cart')
    {{-- end cart --}}
    {{-- header --}}
    {{-- top links --}}
    @include('shop.layout.toplinks')
    {{-- end top links --}}
    {{-- nav-bar --}}
    @include('shop.layout.nav-bar')
    {{-- end nav-bar --}}
    {{-- end header --}}
    {{-- content --}}
    @yield('content')
    {{-- end content --}}
    {{-- footer --}}
    @include('shop.layout.footer')
    {{-- end footer --}}
    {{-- modal --}}
    @include('shop.layout.modal-forms')
    {{-- end modal --}}
    {{-- scripts --}}
    @section('scripts')
        @include('shop.layout.scripts')
    @show

    {{-- end scripts --}}
</body>

</html>
