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
                        <h4 class="page-title mb-1">Data Penjualan</h4>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="data-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Nomor Transaksi</th>
                                        <th width="10%">Tanggal</th>
                                        <th width="20%">Total bayar</th>
                                        <th width="20%">Uang Bayar</th>
                                        <th width="20%">Kembalian</th>
                                        <th width="10%">#</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->

    <!-- Modal keluar -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda Yakin ingin menghapus data ini?</p>
                    <input type="hidden" id="idhapus">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="deleted">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

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
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responseive: true,
            ajax: "{{ route('data_transaksi') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'no_trans' },
                { data: 'no_trans', name: 'no_trans' },
                { data: 'tanggal' },
                { data: 'total_bayar', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 3 },
                { data: 'uang_kembali', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 4 },
                { data: 'kembalian'},
                { data: 'action'},
            ],
            order: [[0, 'DESC']]
        });
    });

    $(document).on('click', '.hapusdata', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#modalHapus').modal('show');
        $('#idhapus').val(id);
        // $.ajax({
        //     type: "GET",
        //     url: "{{ url('/dp') }}/" + id + "/edit",
        //     success: function (response){
        //         $('#idhapus').val(response.data.no_trans);
        //     }
        // });
    });

    $(document).on('click', '#deleted', function(e){
        e.preventDefault();
        var id = $('#idhapus').val();
        $.ajax({
            type: "DELETE",
            url: "{{ url('/hp') }}/" + id,
            data: {'_token': '{{ csrf_token() }}'},
            dataType: 'json',
            success: function (response){
                $('#modalHapus').modal('hide');
                $('.success_message').addClass('alert alert-success');
                $('.success_message').html('Data jusbuah berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button>');
                // $('.success_message').text(response.message);
                $('#data-table').DataTable().ajax.reload();
            }
        });
    });

    </script>
    @endpush
@endsection