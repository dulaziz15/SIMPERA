<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts-lts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 May 2025 10:17:17 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Login | SIMPERA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/logo.png') }}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('template/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('template/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mt-5 mb-md-0 text-center">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{ asset('template/assets/images/logo.png') }}" alt=""
                                            height="28"> <span class="logo-txt">SIMPERA</span>
                                    </a>
                                </div>

                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back !</h5>
                                        <p class="text-muted mt-2">Sign in to continue to SIMPERA.</p>
                                    </div>

                                    @if($errors->has('surel'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('surel') }}
                                        </div>
                                    @endif

                                    <form class="mt-4 pt-2" action="{{ url('/proses_login') }}" method="POST"
                                        id="form-login">
                                        @method('POST')
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="surel" name="surel"
                                                nameplaceholder="Enter Email">
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Password</label>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" id="hash_kata_sandi"
                                                    name="hash_kata_sandi" placeholder="Enter password"
                                                    aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button"
                                                    id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                        <div class="row mb-4">

                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                    </form>

                                    {{-- <div class="mt-4 pt-2 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                        </div>

                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Don't have an account ? <a
                                                href="auth-register.html" class="text-primary fw-semibold"> Signup now
                                            </a> </p>
                                    </div> --}}
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> SIMPERA . Crafted with <i
                                            class="mdi mdi-heart text-danger"></i> by Kelompok 1
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <div id="reviewcarouselIndicators" class="carousel slide"
                                        data-bs-ride="carousel">
                                        <div
                                            class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <!-- end carouselIndicators -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">"Aplikasi ini benar-benar 
                                                        mempermudah saya sebagai mahasiswa dalam melaporkan kerusakan 
                                                        fasilitas di kampus. Proses pelaporan yang cepat dan mudah tanpa perlu 
                                                        datang langsung ke bagian administrasi sangat membantu. Selain itu, saya 
                                                        bisa memantau status laporan secara real-time, jadi saya tahu kapan kerusakan 
                                                        tersebut ditangani. Sangat praktis dan efisien!"
                                                    </h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('template/assets/images/users/avatar-1.jpg') }}"
                                                                    class="avatar-md img-fluid rounded-circle"
                                                                    alt="...">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Brian Hernandez
                                                                </h5>
                                                                <p class="mb-0 text-white-50">Mahasiswa Akuntansi</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">"Bagi kami yang bekerja di bagian 
                                                        pengelolaan fasilitas, aplikasi ini sangat memudahkan dalam memantau dan 
                                                        menangani laporan kerusakan. Dashboard yang tersedia memberikan informasi 
                                                        yang jelas dan terstruktur tentang jenis kerusakan, lokasi, serta status 
                                                        perbaikan. Dengan adanya aplikasi ini, kami bisa lebih cepat merespons laporan 
                                                        dan memastikan fasilitas kampus selalu dalam kondisi optimal."</h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('template/assets/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-md img-fluid rounded-circle"
                                                                    alt="...">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Rosanna French
                                                                </h5>
                                                                <p class="mb-0 text-white-50">Tenaga Pendidik</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white">"Sebagai dosen, aplikasi ini sangat 
                                                        berguna untuk melaporkan kerusakan di ruang kelas atau laboratorium. Dulu, 
                                                        melaporkan kerusakan sering kali memakan waktu dan tenaga. Sekarang, saya hanya 
                                                        perlu beberapa klik, dan kerusakan langsung tercatat dan diprioritaskan. Sistem 
                                                        pelaporan yang transparan memungkinkan saya untuk mengetahui proses perbaikan 
                                                        dengan jelas, sehingga saya bisa memberikan informasi yang tepat kepada mahasiswa."</h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <img src="{{ asset('template/assets/images/users/avatar-3.jpg') }}"
                                                                class="avatar-md img-fluid rounded-circle"
                                                                alt="...">
                                                            <div class="flex-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white">Ilse Rahma Adira</h5>
                                                                <p class="mb-0 text-white-50">Dosen TI
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end carousel-inner -->
                                    </div>
                                    <!-- end review carousel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('template/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('template/assets/libs/pace-js/pace.min.js') }}"></script>
    <!-- password addon init -->
    <script src="{{ asset('template/assets/js/pages/pass-addon.init.js') }}"></script>

</body>


<!-- Mirrored from themesbrand.com/minia/layouts-lts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 May 2025 10:17:17 GMT -->

</html>
