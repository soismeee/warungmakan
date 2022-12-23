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
                        <h4 class="page-title mb-1">Jus Buah</h4>
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
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="hidden" name="id" id="id" value="{{ $kode->kodes }}">
                                            <div class="form-group form-group-custom mb-4">
                                                <input type="text" class="form-control" name="nama" id="nama" required>
                                                <label for="useremail">Nama</label> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-custom mb-4">
                                                <input type="text" class="form-control" name="harga" id="harga" required>
                                                <label for="userpassword">Harga</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-custom mb-4">
                                        <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                                        <label for="username">Keterangan</label>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-info waves-effect waves-light" style="display: none" id="update-jusbuah">Ubah jusbuah</button>
                                        <button class="btn btn-primary waves-effect waves-light" id="add-jusbuah">Tambah jusbuah</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <table id="data-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="30%">Nama</th>
                                        <th width="30%">Harga</th>
                                        <th width="20%">Keterangan</th>
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
    {{-- <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script> --}}
        
    <script>
        $(document).ready(function () {
            loaddata();
        });

    function loaddata(){
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responseive: true,
            ajax: "{{ route('jb.create') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'nama', name: 'nama' },
                { data: 'harga', "render": $.fn.dataTable.render.number('.', ',', 0, 'Rp. '), target: 2 },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'action'},
            ]
        });
    }

    var harga = document.getElementById("harga");
    harga.addEventListener("keyup", function (e) {
        harga.value = convertRupiah(this.value, "Rp. ");
    });
    harga.addEventListener('keydown', function (event) {
        return isNumberKey(event);
    });

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    function isNumberKey(evt) {
        key = evt.which || evt.keyCode;
        if (key != 188 // Comma
            &&
            key != 8 // Backspace
            &&
            key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            &&
            (key < 48 || key > 57) // Non digit
        ) {
            evt.preventDefault();
            return;
        }
    }

    $(document).on('click', '#add-jusbuah', function(e){
        e.preventDefault();
        
        var data = {'id': $('#id').val(), 'nama': $('#nama').val(), 'harga': $('#harga').val(), 'keterangan': $('#keterangan').val(), '_token': '{{ csrf_token() }}'};
        $.ajax({
            type: "POST",
            url: "{{ route('jb.index') }}",
            data: data,
            dataType: 'json',
            success: function (response){
                if (response.status == 401) {
                    $.each(response.errors, function(key, err_values){
                        $('.input').addClass('has-validation');
                        $('#success_message').addClass('alert alert-warning');
                        $('#success_message').text(response.errors);
                    });
                }else{
                    $('#success_message').addClass('alert alert-success alert-dismissible fade show');
                    $('#success_message').text(response.message);
                    $('#data-table').DataTable().ajax.reload();
                    $('#nama').val(null);
                    $('#harga').val(null);
                    $('#keterangan').val(null);
                    $('#id').val(response.kode.kodes);
                }
            }
        });
    });

    $(document).on('click', '#edit-data', function(e){
        e.preventDefault();
        var id = $(this).val();
        $('#update-jusbuah').show();
        $('#add-jusbuah').hide();
        $.ajax({
            type: "GET",
            url: "{{ route('jb.index') }}/"+id,
            success: function (response){
                if (response.status == 401) {
                    $('#success_message').addClass('alert alert-warning');
                    $('#success_message').text(response.errors);
                }else{
                    $('#id').val(response.data.id);
                    $('#nama').val(response.data.nama);
                    $('#keterangan').val(response.data.keterangan);
                    $('#harga').val(response.data.harga);
                    harga.value = convertRupiah(response.data.harga, "Rp. ");
                    isNumberKey(response.data.harga);
                }
            }
        });
    });

    $(document).on('click', '#update-jusbuah', function(e){
        e.preventDefault();
        var data = {'nama': $('#nama').val(), 'harga': $('#harga').val(), 'keterangan': $('#keterangan').val(), '_token': '{{ csrf_token() }}'};
        var id = $('#id').val();
        $.ajax({
            type: "PUT",
            url: "{{ route('jb.index') }}/"+id,
            data: data,
            dataType: 'json',
            success: function (response){
                if (response.status == 404) {
                    $.each(response.errors, function(key, err_values){
                        $('.input').addClass('has-validation');
                        $('#success_message').addClass('alert alert-warning');
                        $('#success_message').text(response.errors);
                    });
                }else{
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#data-table').DataTable().ajax.reload();
                    $('#nama').val(null);
                    $('#harga').val(null);
                    $('#keterangan').val(null);
                    $('#update-jusbuah').hide();
                    $('#add-jusbuah').show();
                    $('#id').val(response.kode.kodes);
                }
            }
        });
    });

    $(document).on('click', '.hapusdata', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#modalHapus').modal('show');
        $.ajax({
            type: "GET",
            url: "{{ route('jb.index') }}/" + id,
            success: function (response){
                $('#idhapus').val(response.data.id);
            }
        });
    });

    $(document).on('click', '#deleted', function(e){
        e.preventDefault();
        var id = $('#idhapus').val();
        $.ajax({
            type: "DELETE",
            url: "{{ route('jb.index') }}/" + id,
            data: {'_token': '{{ csrf_token() }}'},
            dataType: 'json',
            success: function (response){
                $('#modalHapus').modal('hide');
                $('.success_message').addClass('alert alert-success');
                $('.success_message').html('Data jusbuah berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button>');
                $('#data-table').DataTable().ajax.reload();
            }
        });
    });
    </script>
    @endpush
@endsection