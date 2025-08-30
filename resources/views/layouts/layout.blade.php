<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

{{--    Partials Head    --}}
@include('components.head')

<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

<!-- [ Sidebar Menu ] start -->
<x-sidebar>

</x-sidebar>
<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
<x-header>

</x-header>
<!-- [ Header ] end -->


<!-- [ Main Content ] start -->
<div class="pc-container">
    @yield('content')
</div>
<!-- [ Main Content ] end -->
<x-footer>

</x-footer>



{{-- script --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- [Page Specific JS] start -->
<script src="{{ asset("assets/js/plugins/apexcharts.min.js") }}"></script>
<!-- [Page Specific JS] end -->
<!-- Required Js -->
<script src="{{ asset("assets/js/plugins/popper.min.js") }}"></script>
<script src="{{ asset("assets/js/plugins/simplebar.min.js") }}"></script>
<script src="{{ asset("assets/js/plugins/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/js/fonts/custom-font.js") }}"></script>
<script src="{{ asset("/assets/js/pcoded.js") }}"></script>
<script src="{{ asset("assets/js/plugins/feather.min.js") }}"></script>
<script>layout_change('light');</script>
<script>change_box_container('false');</script>
<script>layout_rtl_change('false');</script>
<script>preset_change("preset-1");</script>
<script>font_change("Public-Sans");</script>


@stack('scripts')
</body>
<!-- [Body] end -->

</html>
