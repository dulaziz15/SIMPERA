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

                                    @if ($errors->has('surel'))
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
                            <div class="col-xl-8">
                                <!-- Timeline Section -->
                                <div class="row text-center justify-content-center mb-5">
                                    <div class="col-xl-8 col-lg-10">
                                        <h2 class="fw-bold text-white">Proses Pengajuan Laporan</h2>
                                        <p class="text-white mb-0">Berikut adalah alur proses pengajuan laporan
                                            perbaikan fasilitas.</p>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col">
                                        <div class="timeline-container px-3">
                                            <div class="timeline-steps">
                                                <!-- Step 1 -->
                                                <div class="timeline-step completed">
                                                    <div class="timeline-content" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Laporan diajukan oleh pengguna">
                                                        <div class="timeline-connector-left"></div>
                                                        <div class="inner-circle bg-primary text-white">
                                                            <i class="fas fa-file-alt"></i>
                                                        </div>
                                                        <div class="timeline-connector-right"></div>
                                                        <p class="h6 mt-3 mb-1 fw-semibold text-white">Pelaporan
                                                            Kerusakan</p>
                                                        <p class="small mb-2 text-white">Mahasiswa, dosen, ataupun
                                                            tendik bisa melakukan pelaporan kerusakan fasilitas yang
                                                            ditemukan</p>
                                                    </div>
                                                </div>

                                                <!-- Step 2 -->
                                                <div class="timeline-step completed">
                                                    <div class="timeline-content" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Laporan ditinjau oleh petugas sarpras">
                                                        <div class="timeline-connector-left"></div>
                                                        <div class="inner-circle bg-primary text-white">
                                                            <i class="fas fa-eye"></i>
                                                        </div>
                                                        <div class="timeline-connector-right"></div>
                                                        <p class="h6 mt-3 mb-1 fw-semibold text-white">Peninjauan
                                                            Sarpras</p>
                                                        <p class="small mb-2 text-white">Laporan yang masuk akan
                                                            ditinjau oleh sarana prasarana</p>
                                                    </div>
                                                </div>

                                                <!-- Step 3 -->
                                                <div class="timeline-step completed">
                                                    <div class="timeline-content" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Laporan diverifikasi oleh admin">
                                                        <div class="timeline-connector-left"></div>
                                                        <div class="inner-circle bg-primary text-white">
                                                            <i class="fas fa-check-circle"></i>
                                                        </div>
                                                        <div class="timeline-connector-right"></div>
                                                        <p class="h6 mt-3 mb-1 fw-semibold text-white">Verifikasi Admin
                                                        </p>
                                                        <p class="small mb-2 text-white">Laporan yang telah ditinjau
                                                            akan diverifikasi admin untuk penanganan lebih lanjut</p>
                                                    </div>
                                                </div>

                                                <!-- Step 4 -->
                                                <div class="timeline-step completed">
                                                    <div class="timeline-content" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Proses Penugasan dan Perbaikan">
                                                        <div class="timeline-connector-left"></div>
                                                        <div class="inner-circle bg-primary text-white">
                                                            <i class="fas fa-tools"></i>
                                                        </div>
                                                        <div class="timeline-connector-right"></div>
                                                        <p class="h6 mt-3 mb-1 fw-semibold text-white">Proses Perbaikan
                                                        </p>
                                                        <p class="small mb-2 text-white">Laporan yang telah
                                                            diverifikasi akan dilakukan proses perbaikan</p>
                                                    </div>
                                                </div>

                                                <!-- Step 5 -->
                                                <div class="timeline-step completed">
                                                    <div class="timeline-content" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Proses selesai">
                                                        <div class="timeline-connector-left"></div>
                                                        <div class="inner-circle bg-primary text-white">
                                                            <i class="fas fa-check-double"></i>
                                                        </div>
                                                        <div class="timeline-connector-right"></div>
                                                        <p class="h6 mt-3 mb-1 fw-semibold text-white">Selesai</p>
                                                        <p class="small mb-2 text-white">Proses perbaikan telah
                                                            diselesaikan oleh teknisi</p>
                                                    </div>
                                                </div>

                                                <!-- Step 6 -->
                                                <div class="timeline-step completed">
                                                    <div class="timeline-content" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Pemberian Feedback">
                                                        <div class="timeline-connector-left"></div>
                                                        <div class="inner-circle bg-primary text-white">
                                                            <i class="fas fa-clipboard-check"></i>
                                                        </div>
                                                        <div class="timeline-connector-right"></div>
                                                        <p class="h6 mt-3 mb-1 fw-semibold text-white">Pemberian
                                                            Feedback</p>
                                                        <p class="small mb-2 text-white">Bagi pelapor memberikan
                                                            feedback dari hasil perbaikan yang dilakukan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="p-0 p-sm-4 px-xl-0">
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
                                </div> --}}
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
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<style>
    /* Custom Variables */
    :root {
        --primary: #ffffff;
        --primary-soft: rgba(255, 255, 255, 0.1);
        --success: #4cc9f0;
        --success-soft: rgba(76, 201, 240, 0.1);
        --info: #3a86ff;
        --info-soft: rgba(58, 134, 255, 0.1);
    }

    /* Timeline Container */
    .timeline-container {
        position: relative;
        padding: 2rem 0;
        margin: 0 auto;
        overflow-x: auto;
    }

    /* Timeline Steps */
    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        min-width: 800px;
    }

    /* Timeline Step */
    .timeline-step {
        position: relative;
        flex: 1;
        text-align: center;
        min-width: 120px;
    }

    /* Timeline Content */
    .timeline-content {
        width: 100%;
        text-align: center;
        padding: 0 0.5rem;
        position: relative;
    }

    /* Inner Circle */
    .inner-circle {
        border-radius: 50%;
        height: 60px;
        width: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        border: 3px solid var(--primary);
        color: var(--primary);
        font-size: 1.25rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin: 0 auto;
    }

    /* Active Step */
    .timeline-step.active .inner-circle {
        background-color: var(--success);
        border-color: var(--success);
        transform: scale(1.1);
    }

    /* Timeline Connectors */
    .timeline-connector-left,
    .timeline-connector-right {
        position: absolute;
        top: 30px;
        height: 3px;
        background-color: var(--primary);
        opacity: 0.2;
        z-index: 1;
    }

    .timeline-connector-left {
        left: 0;
        right: 50%;
    }

    .timeline-connector-right {
        left: 50%;
        right: 0;
    }

    /* Completed Steps */
    .timeline-step.completed .inner-circle {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .timeline-step.completed .timeline-connector-left,
    .timeline-step.completed .timeline-connector-right {
        opacity: 0.5;
    }

    /* Button Styles */
    .btn-primary-soft {
        background-color: var(--primary-soft);
        color: var(--primary);
    }

    .btn-success-soft {
        background-color: var(--success-soft);
        color: var(--success);
    }

    .btn-rounded {
        border-radius: 50px;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .timeline-container {
            padding: 1.5rem 0;
        }

        .inner-circle {
            height: 50px;
            width: 50px;
            font-size: 1rem;
        }

        .timeline-connector-left,
        .timeline-connector-right {
            top: 25px;
        }
    }

    @media (max-width: 767.98px) {
        .timeline-steps {
            flex-direction: column;
            align-items: center;
            min-width: auto;
        }

        .timeline-step {
            margin-bottom: 2rem;
            width: 100%;
            max-width: 220px;
        }

        .timeline-connector-left,
        .timeline-connector-right {
            display: none;
        }

        .timeline-step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            height: 2rem;
            width: 3px;
            background-color: var(--primary);
            opacity: 0.2;
            transform: translateX(-50%);
        }

        .timeline-step.completed:not(:last-child)::after {
            opacity: 0.5;
        }
    }

    .btn-pill {
        border-radius: 50px;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.25);
    }
</style>

<!-- Mirrored from themesbrand.com/minia/layouts-lts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 May 2025 10:17:17 GMT -->

</html>
