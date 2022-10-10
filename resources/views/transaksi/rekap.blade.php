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
                        <h4 class="page-title mb-1">Rekap Data Penjualan</h4>
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
                                <h4 class="header-title">Data penjualan hari ini</h4>   
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="15%">Pesanan</th>
                                                <th width="10%">Menu</th>
                                                <th width="20%">Jumlah</th>
                                                <th width="20%">Harga</th>
                                                <th width="20%">Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rekap as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_pesanan }}</td>
                                                <td>{{ $item->menu }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                                <?php $total += $item->total_harga ?>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5"><strong>Total Uang</strong></td>
                                                <td><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Input rekapan harian</h4>
                                <p class="card-title-desc">Rekap harian, inputan elanjaan untuk besok</p>
                                {{-- <form action="{{ route('save_rekap') }}" method="post"> --}}
                                {{-- @csrf     --}}
                                    <div>
                                        <h5 class="font-size-14">Total pendapatan hari ini</h5>
                                        <input type="hidden" name="id" id="id">
                                        <input class="form-control" type="text" name="pendapatan" id="pendapatan" value="Rp. {{ number_format($total, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="mt-2">
                                        <h5 class="font-size-14">Total belanja besok</h5>
                                        <input class="form-control" type="text" name="belanja" id="belanja" placeholder="Masukan jumlah nominal belanja">
                                    </div>
                                    <div class="mt-3">
                                        @if ($data->count())
                                            <button class="btn btn-dark waves-effect waves-light" id="tombol2" disabled>Simpan rekapan</button>
                                            @else
                                            <button class="btn btn-dark waves-effect waves-light" id="tombol" style="display: none" disabled>Simpan rekapan</button>
                                            <button class="btn btn-primary waves-effect waves-light" id="save">Simpan rekapan</button>
                                            @endif
                                            
                                        <button class="btn btn-info waves-effect waves-light" id="update" style="display: none">Ubah rekapan</button>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data Rekap harian</h4>
                                <p class="card-title-desc">Data pada tabel ini digunakan untuk menampilkan semua rekapan harian
                                </p>

                                <table id="data-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="20%">Pendapatan</th>
                                        <th width="20%">Belanja</th>
                                        <th width="20%">Laba</th>
                                        <th width="20%">Tanggal</th>
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
                    { data: 'action'},
                ],
                order: [[0, 'DESC']]
            });
        }


        var belanja = document.getElementById("belanja");
        belanja.addEventListener("keyup", function (e) {
            belanja.value = convertRupiah(this.value, "Rp. ");
        });
        belanja.addEventListener('keydown', function (event) {
            return isNumberKey(event);
        });

        var pendapatan = document.getElementById("pendapatan");

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

        $(document).on('click', '#save', function(e){
            e.preventDefault();
            
            var data = { 'pendapatan': $('#pendapatan').val(), 'belanja': $('#belanja').val(), '_token': '{{ csrf_token() }}'};
            $.ajax({
                type: "POST",
                url: "{{ route('save_rekap') }}",
                data: data,
                dataType: 'json',
                success: function (response){
                    console.log(response);
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
                        $('#pendapatan').val(null);
                        $('#belanja').val(null);
                        $('#tombol').show()
                        $('#save').hide()
                    }
                }
            });
        });

        $(document).on('click', '.editdata', function(e){
            e.preventDefault();
            var id = $(this).val();
            $('#tombol').hide();
            $('#tombol2').hide();
            $('#update').show();
            $.ajax({
                type: "GET",
                url: "{{ url('rs') }}/"+id,
                success: function (response){
                    if (response.status == 401) {
                        $('#success_message').addClass('alert alert-warning');
                        $('#success_message').text(response.errors);
                    }else{
                        $('#id').val(response.data.id);
                        $('#pendapatan').val(response.data.pendapatan);
                        pendapatan.value = convertRupiah(response.data.pendapatan, "Rp. ");
                        isNumberKey(response.data.pendapatan);

                        $('#belanja').val(response.data.belanja);
                        belanja.value = convertRupiah(response.data.belanja, "Rp. ");
                        isNumberKey(response.data.belanja);
                    }
                }
            });
        });

        $(document).on('click', '#update', function(e){
        e.preventDefault();
        var data = {'pendapatan': $('#pendapatan').val(), 'belanja': $('#belanja').val(), '_token': '{{ csrf_token() }}'};
        var id = $('#id').val();
        $.ajax({
            type: "PUT",
            url: "{{ url('ur') }}/"+id,
            data: data,
            dataType: 'json',
            success: function (response){
                if (response.status == 404) {
                    $.each(response.errors, function(key, err_values){
                        console.log(response);
                        $('.input').addClass('has-validation');
                        $('#success_message').addClass('alert alert-warning');
                        $('#success_message').text(response.errors);
                    });
                }else{
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#data-table').DataTable().ajax.reload();
                    $('#pendapatan').val(null);
                    $('#belanja').val(null);
                    $('#tombol2').show();
                    $('#update').hide();
                }
            }
        });
    });
    </script>
    @endpush
@endsection