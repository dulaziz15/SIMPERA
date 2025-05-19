<!doctype html>
<html lang="en">
@include('layout.header')

<body>
    <div id="layout-wrapper">
        @include('layout.navbar')

        @include('layout.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @include('layout.breadcrumb')
                    @yield('content')
                </div>
            </div>

            @include('layout.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    @include('layout.right_sidebar')

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('template/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/feather-icons/feather.min.js')}}"></script>
    <!-- pace js -->
    <script src="{{ asset('template/assets/libs/pace-js/pace.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('template/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('template/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- dashboard init -->
    <script src="{{ asset('template/assets/js/pages/dashboard.init.js')}}"></script>

    <script src="{{ asset('template/assets/js/app.js')}}"></script>

</body>


<!-- Mirrored from themesbrand.com/minia/layouts-lts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 May 2025 10:16:15 GMT -->

</html>
