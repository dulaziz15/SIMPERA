<!DOCTYPE html>
<html lang="en">

@include('layout.header')

<body>
    <div id="layout-wrapper">
        @include('layout.navbar')

        @include('layout.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid p-4">
                    @include('layout.breadcrumb')
                    @yield('content')
                </div>
            </div>

            @include('layout.footer')
        </div>
    </div>


    @include('layout.right_sidebar')

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Tambahkan ini di layout utama atau sebelum script jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('template/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('template/assets/libs/pace-js/pace.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('template/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('template/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('template/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>
    <!-- dashboard init -->
    <script src="{{ asset('template/assets/js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('template/assets/js/app.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('template/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('template/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- pristine js -->
    <script src="{{ asset('template/assets/libs/pristinejs/pristine.min.js') }}"></script>
    <!-- form validation -->
    <script src="{{ asset('template/assets/js/pages/form-validation.init.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('template/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- init js -->
        <script src="{{ asset('template/assets/js/pages/form-advanced.init.js') }}"></script><!-- datepicker js -->
        <script src="{{ asset('template/assets/libs/flatpickr/flatpickr.min.js') }}"></script><!-- choices js -->
        <script src="{{ asset('template/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
