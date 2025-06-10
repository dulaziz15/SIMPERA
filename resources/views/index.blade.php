@extends('layout.app')

@section('content')
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah User</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $user->count() }}">0</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Jumlah User Pada Sistem</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Laporan</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $laporan->count() }}">0</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Jumlah Laporan yang dibuat</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Ruangan</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $ruangan->count() }}">0</span>
                            </h4>
                        </div>
                        <div class="col-6">
                            <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2">
                            </div>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Jumlah Ruanganan yang terdaftar</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Fasilitas</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $fasilitas->count() }}">0</span>
                            </h4>
                        </div>
                        <div class="col-6">
                            <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2">
                            </div>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Jumlah Fasilitas yang ada didalam sistem</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row-->

    <div class="row">
        <div class="col-xl-6">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Laporan</h4>
                </div>
                <div class="card-body">
                    <div class="total mb-3">
                        Jumlah Seluruh Laporan <span class="badge bg-primary">{{ $laporan->count() }}</span>
                    </div>
                    <div id="pie-chart" data-colors='["#fd625e", "#2ab57d", "#4ba6ef", "#ffbf53", "#5156be"]'
                        class="e-charts"></div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-xl-6">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data User</h4>
                </div>
                <div class="card-body">
                    <div class="total mb-3">
                        Jumlah Seluruh User <span class="badge bg-primary">{{ $user->count() }}</span>
                    </div>
                    <div id="pie-chart-user"
                        data-colors='["#fd625e", "#2ab57d", "#4ba6ef", "#ffbf53", "#5156be", "#bf00ff"]' class="e-charts">
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div> <!-- end row-->


    <div class="row">
        <div class="col-xl-12">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Fasilitas</h4>
                </div>
                <div class="card-body">
                    <div class="total mb-3">
                        Jumlah Seluruh Fasilitas <span class="badge bg-primary">{{ $fasilitas->count() }}</span>
                    </div>
                    <div id="pie-chart-fasilitas" data-colors='["#fd625e", "#2ab57d", "#4ba6ef", "#ffbf53", "#5156be"]'
                        class="e-charts"></div>
                </div>
            </div>
            <!-- end card -->
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
