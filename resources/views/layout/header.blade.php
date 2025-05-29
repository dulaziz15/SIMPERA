<!-- Mirrored from themesbrand.com/minia/layouts-lts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 May 2025 10:15:48 GMT -->

<head>

    <meta charset="utf-8" />
    <title>SIMPERA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- choices css -->
    <link href="{{ asset('template/assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- plugin css -->
    <link href="{{ asset('template/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('template/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('template/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('template/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('template/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
        
        <!-- twitter-bootstrap-wizard css -->
        <link rel="stylesheet" href="{{ asset('template/assets/libs/twitter-bootstrap-wizard/prettify.css')}}">
    <style>
        .card {
            -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
            box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        }

        .card-h-100 {
            -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
            box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        }

        .vertical-menu {
            -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125) !important;
            box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125) !important;
        }
    </style>
    @stack('css')
</head>
