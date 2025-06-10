<!doctype html>
<html lang="en">
<!-- Mirrored from themesbrand.com/minia/layouts-lts/pages-comingsoon.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 May 2025 10:17:18 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>SIMPERA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('template/assets/images/logo.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- swiper css -->
        <link rel="stylesheet" href="template/assets/libs/swiper/swiper-bundle.min.css">

        <!-- preloader css -->
        <link rel="stylesheet" href="template/assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="template/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="template/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="template/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
        <div class="preview-img overflow-hidden ">
            <div class="swiper-container preview-thumb">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-bg" style="background-image: url(template/assets/images/bg-1.jpg);"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-bg" style="background-image: url(template/assets/images/bg-2.jpg);"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-bg" style="background-image: url(template/assets/images/bg-3.jpg);"></div>
                    </div>
                </div>
            </div>
            <!-- preview-thumb -->
            <div class="swiper-container preview-thumbsnav">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div>
                            <img src="template/assets/images/bg-1.jpg" alt=""
                                class="avatar-sm nav-img rounded-circle">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <img src="template/assets/images/bg-2.jpg" alt=""
                                class="avatar-sm nav-img rounded-circle">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <img src="template/assets/images/bg-3.jpg" alt=""
                                class="avatar-sm nav-img rounded-circle">
                        </div>
                    </div>
                </div>
            </div>
            <!-- preview-thumb -->
        </div>
        <!-- preview bg -->

        <div class="coming-content min-vh-100 py-4 px-3 py-sm-5">
            <div class="bg-overlay bg-primary"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center py-4 py-sm-5">

                            <div class="mb-5">
                                <a href="index.html">
                                    <img src="template/assets/images/logo.png" alt="" height="30" class="me-1"><span class="logo-txt text-white font-size-22">SIMPERA</span>
                                </a>
                            </div>
                            <h1 class="text-white mt-5">Sistem Manajemen Pelaporan dan Perbaikan Fasilitas Kampus</h1>
                            <p class="text-white-50 mt-4 mb-5 font-size-20">Laporkan kerusakan fasilitas kampus dengan mudah dan pantau status perbaikan secara real-time.</p>
                            
                            <a href="{{ route('login') }}" class="btn-mulai btn-start btn-blue waves-effect mt-5">Mulai Sekarang</a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end col -->
    </div> <!-- end row-->
@endsection
@push('scripts')
    <script>
        function getChartColorsArray(e) {
            e = $(e).attr("data-colors");
            return (e = JSON.parse(e)).map(function(e) {
                e = e.replace(" ", "");
                if (-1 == e.indexOf("--")) return e;
                e = getComputedStyle(document.documentElement).getPropertyValue(e);
                return e || void 0
            })
        }
        var pieColors = getChartColorsArray("#pie-chart"),
            dom = document.getElementById("pie-chart"),
            myChart = echarts.init(dom),
            app = {};
        option = null, option = {
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: "vertical",
                left: "left",
                data: ["Laporan Baru", "Laporan Diproses", "Laporan Diverifikasi",
                    "Laporan Selesai"
                ],
                textStyle: {
                    color: "#858d98"
                }
            },
            color: pieColors,
            series: [{
                name: "Total sales",
                type: "pie",
                radius: "55%",
                center: ["50%", "60%"],
                label: {
                    show: true,
                    position: 'outside',
                    formatter: '{b}: {c} ({d}%)',
                    fontSize: 14,
                },
                data: [{
                    value: {{ $laporan->filter(function ($item) {
                            return in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::BARU->value]);
                        })->count() }},
                    name: "Laporan Baru"
                }, {
                    value: {{ $laporan->filter(function ($item) {
                            return in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::DIAJUKAN->value]);
                        })->count() }},
                    name: "Laporan Diproses"
                }, {
                    value: {{ $laporan->filter(function ($item) {
                            return in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::VERIFIKASI->value]);
                        })->count() }},
                    name: "Laporan Diverifikasi"
                }, {
                    value: {{ $laporan->filter(function ($item) {
                            return in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::SELESAI->value]);
                        })->count() }},
                    name: "Laporan Selesai"
                }],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: "rgba(0, 0, 0, 0.5)"
                    }
                }
            }]
        }, option && "object" == typeof option && myChart.setOption(option, !0);

        var pieColors = getChartColorsArray("#pie-chart-user"),
            dom = document.getElementById("pie-chart-user"),
            myChart = echarts.init(dom),
            app = {};
        option = null, option = {
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: "vertical",
                left: "left",
                data: ["Admin", "Sarpras", "Teknisi", "Mahasiswa", "Dosen",
                    "Tenaga Pendidik"
                ],
                textStyle: {
                    color: "#858d98"
                }
            },
            color: pieColors,
            series: [{
                name: "Total User",
                type: "pie",
                radius: "55%",
                center: ["50%", "60%"],
                label: {
                    show: true,
                    position: 'outside',
                    formatter: '{b}: {c} ({d}%)',
                    fontSize: 14,
                },
                data: [{
                        value: {{ $user->filter(function ($item) {
                                return in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::ADMIN->value]);
                            })->count() }},
                        name: "Admin"
                    }, {
                        value: {{ $user->filter(function ($item) {
                                return in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::SARANA_PRASARANA->value]);
                            })->count() }},
                        name: "Sarpras"
                    }, {
                        value: {{ $user->filter(function ($item) {
                                return in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::TEKNISI->value]);
                            })->count() }},
                        name: "Teknisi"
                    }, {
                        value: {{ $user->filter(function ($item) {
                                return in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::MAHASISWA->value]);
                            })->count() }},
                        name: "Mahasiswa"
                    },
                    {
                        value: {{ $user->filter(function ($item) {
                                return in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::DOSEN->value]);
                            })->count() }},
                        name: "Dosen"
                    }, {
                        value: {{ $user->filter(function ($item) {
                                return in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::TENAGA_KEPENDIDIKAN->value]);
                            })->count() }},
                        name: "Tenaga Pendidik"
                    }
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: "rgba(0, 0, 0, 0.5)"
                    }
                }
            }]
        }, option && "object" == typeof option && myChart.setOption(option, !0);

        var pieColors = getChartColorsArray("#pie-chart-fasilitas"),
            dom = document.getElementById("pie-chart-fasilitas"),
            myChart = echarts.init(dom),
            app = {};
        option = null, option = {
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: "vertical",
                left: "left",
                data: ["Fasilitas Umum", "Fasilitas Penunjang", "Fasilitas Inti"],
                textStyle: {
                    color: "#858d98"
                }
            },
            color: pieColors,
            series: [{
                name: "Total Fasilitas",
                type: "pie",
                radius: "55%",
                center: ["50%", "60%"],
                label: {
                    show: true,
                    position: 'outside',
                    formatter: '{b}: {c} ({d}%)',
                    fontSize: 14,
                },
                data: [{
                    value: {{ $fasilitas->filter(function ($item) {
                            return in_array($item->kategori->kode, ['FSU']);
                        })->count() }},
                    name: "Fasilitas Umum"
                }, {
                    value: {{ $fasilitas->filter(function ($item) {
                            return in_array($item->kategori->kode, ['FSP']);
                        })->count() }},
                    name: "Fasilitas Penunjang"
                }, {
                    value: {{ $fasilitas->filter(function ($item) {
                            return in_array($item->kategori->kode, ['FSI']);
                        })->count() }},
                    name: "Fasilitas Inti"
                }, ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: "rgba(0, 0, 0, 0.5)"
                    }
                }
            }]
        }, option && "object" == typeof option && myChart.setOption(option, !0);
    </script>
@endpush
