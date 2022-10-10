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
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header bg-transparent border-bottom">
                                <h4>Profil Pengguna</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <p>
                                        Nama : {{ auth()->user()->name }} <br />
                                        Username : {{ auth()->user()->username }} <br />
                                    </p>
                                    <footer class="blockquote-footer">
                                        Hak akses : @if (auth()->user()->role == 1)
                                            Owner
                                            @else
                                            Karyawan
                                            @endif
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Ubah profil pengguna</h4>
                                <p class="card-title-desc">Anda dapat mengubah data pengguna anda, ubah data yang diperlukan.</p>
                                <form action="{{ url('ubahprofil') }}/{{ auth()->user()->id }}" method="post">
                                @method('PUT')
                                @csrf
                                    <div>
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
                                            <label for="name">Nama</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="text" class="form-control" name="username" id="username" value="{{ auth()->user()->username }}">
                                                    <label for="username">Username</label> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="password" class="form-control" name="password" id="password">
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
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
                    { data: 'pendapatan', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 1 },
                    { data: 'belanja', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 2 },
                    { data: 'laba', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 3 },
                    { data: 'tanggal'},
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