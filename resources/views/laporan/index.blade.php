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
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Biaya Perbaikan Selesai</span>
                            <h4 class="mb-3">
                                Rp. <span class="">{{ $totalBiaya }}</span>
                            </h4>
                        </div>
                        <div class="col-6">
                            <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2">
                            </div>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Jumlah Pengeluaran yang telah dilakukan</span>
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
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('laporan/') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ request('start_date') ?? $periode->tanggal_mulai }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ request('end_date') ?? $periode->tanggal_selesai }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                <a href="{{ url('laporan') }}" class="btn btn-secondary">
                                    <i class="fas fa-sync-alt me-1"></i> Reset
                                </a>
                            </div>
                            <div class="col-md-3 d-flex align-items-end justify-content-end">
                                <div class="badge bg-info text-white p-2">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Periode:
                                    {{ request('start_date') ? date('d M Y', strtotime(request('start_date'))) : $periode->tanggal_mulai }}
                                    -
                                    {{ request('end_date') ? date('d M Y', strtotime(request('end_date'))) : $periode->tanggal_selesai }}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-xl-6">
            <div class="card border-0 h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0"> Perkiraan Biaya Perbaikan </h4>
                </div>
                <div class="card-body">
                    <div class="ranking-list">
                        {{-- @dd($perkiraanBiayaPerbaikan) --}}
                        @foreach ($perkiraanBiayaPerbaikan->take(5) as $i => $item)
                            <div
                                class="ranking-item d-flex align-items-center mb-3 p-3 bg-light-hover rounded-3 transition-all">
                                <div class="rank-circle me-3 d-flex align-items-center justify-content-center 
                        bg-{{ $i < 3 ? 'primary' : 'secondary' }} text-white rounded-circle fs-5 fw-bold"
                                    style="width: 36px; height: 36px; flex-shrink: 0;">
                                    {{ $i + 1 }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="d-flex align-items-center gap-2">
                                            <strong class="text-dark">{{ $item['fasilitas']->nama }}</strong>
                                            <span class="badge bg-{{ $item->status->color() }} rounded-pill py-1 px-2">
                                                {{ $item->status->label() }}
                                            </span>
                                        </div>
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill py-1 px-3">
                                            <i class="fas fa-coins me-1"></i> Rp.
                                            {{ number_format($item['perkiraan_biaya'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="text-muted small d-flex align-items-center">
                                        <i class="fas fa-door-open me-1 text-muted"></i>
                                        {{ $item['fasilitas']->ruangan->nama }} •
                                        <i class="fas fa-building ms-2 me-1 text-muted"></i>
                                        {{ $item['fasilitas']->ruangan->gedung->nama }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-xl-6">
            <!-- card -->
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Fasilitas Sering Dilaporkan</h4>
                </div>
                <div class="card-body">
                    <div class="ranking-list">
                        {{-- @dd($fasilitasSeringDilaporkan) --}}
                        @foreach ($fasilitasSeringDilaporkan->take(5) as $i => $item)
                            <div class="ranking-item d-flex align-items-center mb-3">
                                <div class="rank-circle me-3 d-flex align-items-center justify-content-center bg-{{ $i < 3 ? 'primary' : 'secondary' }} text-white rounded-circle"
                                    style="width: 40px; height: 40px;">
                                    {{ $i + 1 }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <strong>{{ $item['fasilitas']->nama }}</strong>
                                            <span
                                                class="badge bg-{{ $item['fasilitas']->laporan->status->color() }} rounded-pill">
                                                {{ $item['fasilitas']->laporan->status }}
                                            </span>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="fas fa-users me-1"></i> {{ $item['total'] }} Pelapor
                                        </span>
                                    </div>
                                    <div class="text-muted small">
                                        {{ $item['fasilitas']->ruangan->nama }} •
                                        {{ $item['fasilitas']->ruangan->gedung->nama }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div> <!-- end row-->


    <div class="row">
        <div class="col-xl-4">
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
        </div>
        <div class="col-xl-4">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Laporan</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="total mb-3">
                        Jumlah Seluruh Laporan <span class="badge bg-primary">{{ $laporan->count() }}</span>
                    </div>
                    <div id="pie-chart" data-colors='["#fd625e", "#2ab57d", "#4ba6ef", "#ffbf53", "#5156be"]'
                        class="e-charts flex-grow-1"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
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

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Mix Line-Bar</h4>
                </div>
                <div class="card-body p-5">
                    <div id="mix-line-bar" data-colors='["#2ab57d", "#5156be", "#fd625e"]' class="e-charts">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <style>
            .ranking-item {
                padding: 10px;
                border-radius: 8px;
                background-color: #f8f9fa;
                transition: all 0.2s;
            }

            .ranking-item:hover {
                background-color: #e9ecef;
                transform: translateY(-2px);
            }

            .rank-circle {
                font-weight: bold;
                font-size: 1.1rem;
            }
        </style>
    @endpush
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
                        formatter: "{b} : {c} ({d}%)"
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
                        formatter: "{b} : {c} ({d}%)"
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
                        formatter: "{b} : {c} ({d}%)"
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

            var mixlinebarColors = getChartColorsArray("#mix-line-bar"),
                dom = document.getElementById("mix-line-bar"),
                myChart = echarts.init(dom);

            var option = {
                grid: {
                    left: 80,
                    right: 50,
                    top: 30,
                    bottom: 30
                },
                tooltip: {
                    trigger: "axis",
                    axisPointer: {
                        type: "shadow"
                    }
                },
                toolbox: {
                    orient: "vertical",
                    left: 0,
                    top: 20,
                    feature: {
                        dataView: {
                            readOnly: false,
                            title: "Lihat Data"
                        },
                        magicType: {
                            type: ["line", "bar"],
                            title: {
                                line: "Tampilkan Garis",
                                bar: "Tampilkan Batang"
                            }
                        },
                        restore: {
                            title: "Kembalikan"
                        },
                        saveAsImage: {
                            title: "Unduh Gambar"
                        }
                    }
                },
                color: mixlinebarColors,
                legend: {
                    data: ["Jumlah Laporan"],
                    textStyle: {
                        color: "#858d98"
                    }
                },
                xAxis: [{
                    type: "category",
                    data: @json(collect($laporanPerPeriode)->pluck('nama_periode')),
                    axisPointer: {
                        type: "shadow"
                    },
                    axisLine: {
                        lineStyle: {
                            color: "#858d98"
                        }
                    }
                }],
                yAxis: [{
                    type: "value",
                    name: "Jumlah Laporan",
                    min: 0,
                    axisLine: {
                        lineStyle: {
                            color: "#858d98"
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: "rgba(133, 141, 152, 0.1)"
                        }
                    },
                    axisLabel: {
                        formatter: "{value}"
                    }
                }],
                series: [{
                    name: "Jumlah Laporan",
                    type: "bar",
                    data: @json(collect($laporanPerPeriode)->pluck('jumlah_laporan')),
                }]
            };

            // Terapkan ke chart
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        </script>
    @endpush
@endsection
