@extends('layout.main')

@push('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 
@endpush

@section('container')
    <div class="page-content">
                        
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Dashboard</h4>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                @can('owner')
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-6">
                                        <h5>Welcome Back !</h5>
                                        <p class="text-muted">{{ auth()->user()->name }}</p>

                                        <div class="mt-4">
                                            <a href="{{ route('ip') }}" class="btn btn-primary btn-sm">Input Transaksi <i class="mdi mdi-arrow-right ml-1"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-5 ml-auto">
                                        <div>
                                            <img src="{{ asset('assets/images/widget-img.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">Pendapatan Bulan ini</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">{{ date('F Y', strtotime(now())) }}</p>
                                        <h4>Rp. {{ number_format($bulanan, 0, ',', '.') }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <input data-plugin="knob" data-width="56" data-height="56" data-linecap=round data-displayInput=false data-fgColor="#3051d3" value="56" data-skin="tron" data-angleOffset="56" data-readOnly=true data-thickness=".17" />
                                    </div>
                                </div>
                                <hr>
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted">Pendapatan hari ini</p>
                                        <h5 class="mb-0"> Rp. {{ number_format($harian, 0, ',', '.') }}<span class="font-size-14 text-muted ml-1"> {{ $jumlah->count() }} transaksi</span></h5>
                                    </div>

                                    <div class="align-self-end ml-2">
                                        <a href="{{ route('rl') }}" class="btn btn-primary btn-sm">Lihat data</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-transparent p-3">
                                <h5 class="header-title mb-0">Rekap Laporan Bulanan</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Pendapatan</p>
                                            <h5 class="mb-0">Rp. {{ number_format($pendapatan, 0, ',', '.') }}</h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-layer-group"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media my-2">
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Laba </p>
                                            <h5 class="mb-0">Rp. {{ number_format($laba, 0, ',', '.') }}</h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-analytics"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media my-2">
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Belanja</p>
                                            <h5 class="mb-0">Rp. {{ number_format($belanja, 0, ',', '.') }}</h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-box"></i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Laporan Data Rekap</h4>
                                <p class="card-title-desc">Data pada tabel ini digunakan untuk menampilkan semua rekapan harian
                                </p>

                                <table id="data-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Pendapatan</th>
                                        <th width="20%">Belanja</th>
                                        <th width="20%">Laba</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                @endcan

                @can('karyawan')
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-6">
                                        <h5>Welcome Back !</h5>
                                        <p class="text-muted">{{ auth()->user()->name }}</p>

                                        <div class="mt-4">
                                            <a href="{{ route('ip') }}" class="btn btn-primary btn-sm">Input Transaksi <i class="mdi mdi-arrow-right ml-1"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-5 ml-auto">
                                        <div>
                                            <img src="{{ asset('assets/images/widget-img.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">Pendapatan Hari ini</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">{{ date('d F Y', strtotime(now())) }}</p>
                                        <h4>Rp. {{ number_format($harian, 0, ',', '.') }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <input data-plugin="knob" data-width="56" data-height="56" data-linecap=round data-displayInput=false
                                        data-fgColor="#3051d3" value="56" data-skin="tron" data-angleOffset="56"
                                        data-readOnly=true data-thickness=".17" />
                                    </div>
                                </div>
                                <hr>
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted">Jumlah transaksi hari ini</p>
                                        <h5 class="mb-0"> {{ $jumlah->count() }} transaksi</h5>
                                    </div>

                                    <div class="align-self-end ml-2">
                                        <a href="{{ route('rl') }}" class="btn btn-primary btn-sm">Lihat data</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data transaksi hari ini</h4>
                                <p class="card-title-desc">Data transaksi dapat dilihat pada tabel dibawah ini
                                </p>

                                <table id="data-harian" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="30%">No Transaksi</th>
                                        <th width="25%">Tanggal</th>
                                        <th width="35%">Total bayar</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                @endcan

            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->

    @push('js')

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script> --}}
    <script>
        $(document).ready(function () {
            loaddata();
            loaddata2();
        });

        function loaddata(){
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                responseive: true,
                ajax: "{{ route('dr') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'id' },
                    { data: 'tanggal'},
                    { data: 'pendapatan', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 2 },
                    { data: 'belanja', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 3 },
                    { data: 'laba', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 4 },
                ],
                order: [[0, 'DESC']]
            });
        }

        function loaddata2(){
            $('#data-harian').DataTable({
                processing: true,
                serverSide: true,
                responseive: true,
                ajax: "{{ route('rh') }}",
                columns: [
                { data: 'DT_RowIndex', name: 'no_trans' },
                { data: 'no_trans', name: 'no_trans' },
                { data: 'tanggal' },
                { data: 'total_bayar', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 3 },
            ],
            order: [[0, 'DESC']]
            });
        }
    </script>
    @endpush
@endsection