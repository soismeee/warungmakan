@extends('layout.main')

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
                                <h4 class="header-title">Pilih Menu</h4>
                                <h6>Klik Menu untuk tampil atau hilangkan menu</h6>
                                <h6>Menu yang terpilih akan masuk pada tabel disamping</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">
                                    <a class="btn btn-info mt-1 mr-1" data-toggle="collapse" href="#menuMakanan" aria-expanded="false" aria-controls="menuMakanan">
                                        Makanan
                                    </a>
                                    <button class="btn btn-danger mt-1 mr-1" type="button" data-toggle="collapse" data-target="#menuMinuman" aria-expanded="false" aria-controls="menuMinuman">
                                        Minuman
                                    </button>
                                    <button class="btn btn-dark mt-1 mr-1" type="button" data-toggle="collapse" data-target="#menuJusBuah" aria-expanded="false" aria-controls="menuJusBuah">
                                        Jus Buah
                                    </button>
                                </p>
                                <div class="collapse" id="menuMakanan">
                                    <div class="card card-body mt-3 mb-0">
                                        @foreach ($makanan as $ma)                                            
                                            <dl class="row mb-0">
                                                <dd class="col-sm-9">
                                                    <dl class="row mb-0">
                                                        <dd class="col-sm-8 mt-2">{{ $ma->nama }}</dd>
                                                    </dl>
                                                </dd>
                                                <dt class="col-sm-2 mt-1"><button class="btn btn-primary btn-sm add-pesan" value="{{ $ma->id }}" data-menu="makanan"><i class="mdi mdi-plus-thick"></i></button></dt>
                                            </dl>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse" id="menuMinuman">
                                    <div class="card card-body mt-3 mb-0">
                                        @foreach ($minuman as $mi)                                            
                                            <dl class="row mb-0">
                                                <dd class="col-sm-9">
                                                    <dl class="row mb-0">
                                                        <dd class="col-sm-8 mt-2">{{ $mi->nama }}</dd>
                                                    </dl>
                                                </dd>
                                                <dt class="col-sm-2 mt-1"><button class="btn btn-primary btn-sm add-pesan" value="{{ $mi->id }}" data-menu="minuman"><i class="mdi mdi-plus-thick"></i></button></dt>
                                            </dl>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse" id="menuJusBuah">
                                    <div class="card card-body mt-3 mb-0">
                                        @foreach ($jusbuah as $jb)                                            
                                            <dl class="row mb-0">
                                                <dd class="col-sm-10">
                                                        <dd class="col-sm-8 mt-2">{{ $jb->nama }}</dd>
                                                </dd>
                                                <dt class="col-sm-2 mt-1"><button class="btn btn-primary btn-sm add-pesan" value="{{ $jb->id }}" data-menu="jusbuah"><i class="mdi mdi-plus-thick"></i></button></dt>
                                            </dl>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Daftar List Pesanan</h4>
                                <p class="card-title-desc">Data pada tabel dapat di hapus dengan klik tong sampah, <strong>Jumlah pesanan dapat diubah pada tabel ini</strong></p>
                                <form action="{{ route('simpan') }}" method="post" class="form-pesanan">
                                    @csrf    
                                    <div class="table-responsive">
                                        <input type="hidden" name="no_trans" id="no_trans" value="{{ $kode->kodes }}">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><a type="button" class="action-icon btn-remove"><i class="mdi mdi-delete"></i></a></th>
                                                    <th width="40%">Pesanan</th>
                                                    <th width="20%">Harga</th>
                                                    <th width="15%">Jumlah</th>
                                                    <th width="20%">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot style="display:none">
                                                <tr class="bg-light">
                                                    <th colspan="3">Total Bayar</th>
                                                    <th colspan="2" class="grand-total"></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5">
                                                        <strong>Note :</strong> Pastikan semua jumlah pesanan sesuai, setelahnya dapat input jumlah uang yang dibayar oleh pelanggan.
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Uang Bayar</th>
                                                    <th colspan="2"><input type="text" class="form-control" name="cash" id="cash"></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Uang Kembali</th>
                                                    <th colspan="2"><strong><div id="kembalian">Masukan nominal uang, setelahnya klik disini</div></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th colspan="2"><button type="submit" disabled class="btn btn-lg btn-dark" id="buat-pesanan">Buat Pesanan <i class="fas fa-shopping-cart"></i></button></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </form>
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

    <!--  Modal notifikasi -->
    <div class="modal fade Notifikasi" id="Notifikasi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="icons-xl uim-icon-warning my-4">
                            <i class="uim uim-exclamation-triangle"></i>
                        </div>
                        <h4 class="alert-heading font-size-20">Menu sudah dipilih</h4>
                        <p class="text-muted">Silahkan pilih menu lain</p>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Dimengerti</button>
                        
                    </div>
                </div>
                    <div class="modal-footer">
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    @push('js')
    <script>
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

        $(document).ready(function() {
            
            let arrayPesanan = [];
            $(document).on('click', '.add-pesan', function(e) {
                e.preventDefault();
                let id = $(this).val();
                let menu = $(this).data('menu');
                if (!id) return $('#Notifikasi').modal('show');
                if (arrayPesanan.filter(item => item.id == id).length > 0) return $('#Notifikasi')
                    .modal('show');
                $('.isipesan').text("Menu ini sudah dipilih, silahkan pilih menu lain!!");

                if (menu == "makanan") {
                    var url = "{{ route('ma.index') }}/" + id;
                } else if(menu == "minuman") {
                    var url = "{{ route('mi.index') }}/" + id;
                } else{
                    var url = "{{ route('jb.index') }}/" + id;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            let html =
                                '<tr id="'+response.data.id+'">\
                                    <td><a data-id="'+response.data.id+'" type="button" class="action-icon remove-item"> <i class="mdi mdi-delete"></i></a><input type="hidden" name="menu[]" value="'+menu+'"></td>\
                                    <td>'+response.data.nama+'<input type="hidden" name="id_pesanan[]" value="'+response.data.id+'"> <input type="hidden" name="nama_pesanan[]" value="'+response.data.nama+'"></td>\
                                    <td> Rp. '+response.data.harga+'<input type="hidden" name="harga[]" value="'+response.data.harga+'"></td>\
                                    <td><input type="number" name="jumlah[]" id="jumlah" data-harga="'+response.data.harga+'" data-id="'+response.data.id+'" class="form-control jumlah" value="1" min="1"></td>\
                                    <td> Rp. '+response.data.harga+'</td>\
                                </tr>';
                            arrayPesanan.push({
                                id: response.data.id,
                                jumlah: 1,
                                total: response.data.harga
                            });
                            let grand_total = 0;
                            arrayPesanan.forEach(val => grand_total = grand_total + parseInt(val.total));
                            $('.form-pesanan table tbody').append(html);
                            $('tfoot').show();
                            $('.grand-total').html('<h4>Rp. '+grand_total+'</h4> <input type="hidden" id="grand_total" name="grand_total" value="'+grand_total+'">');
                            $('.form-pesanan #obatid').val(JSON.stringify(arrayPesanan));
                        }
                    }
                });
                
            });

            $(document).on('change', '.jumlah', function() {
                let id = $(this).data('id');
                let jumlah = $(this).val();
                let harga = $(this).data('harga');
                let total = jumlah * harga;
                $('.form-pesanan #' + id + ' td:last').html('Rp. ' + total);
                objIndex = arrayPesanan.findIndex((obj => obj.id == id));
                arrayPesanan[objIndex].jumlah = jumlah;
                arrayPesanan[objIndex].total = total;
                countGrandTotal();
            });

            $('.form-pesanan table').on('click', '.btn-remove', function() {
                if (arrayPesanan.length == 0) return $('#datapesanannotselect').modal('show');
                arrayPesanan = [];
                $('.form-pesanan table tbody').html('');
                $('.form-pesanan #data_pesanan').html('');
                $('.grand-total').html('');
                $('.form-pesanan table tfoot').hide();
                countGrandTotal();
            });

            $('.form-pesanan table').on('click', '.remove-item', function() {
                if (arrayPesanan.length == 0) return alert('Belum ada item pesanan dipilih!');
                $(this).parent().parent().remove();
                let id = $(this).data('id');
                arrayPesanan = arrayPesanan.filter(e => e.id != id);
                $('.form-pesanan #data_pesanan').val(JSON.stringify(arrayPesanan));
                countGrandTotal();
            });

            function countGrandTotal() {
                let grand_total = 0;
                arrayPesanan.forEach(val => grand_total = grand_total + parseInt(val.total));
                if (grand_total <= 0) {
                    $('.form-pesanan table tfoot').hide();
                }
                $('.grand-total').html('<h4>Rp. '+grand_total+'</h4><input type="hidden" id="grand_total" name="grand_total" value="'+grand_total+'">')
            }
        });

        var cash = document.getElementById("cash");
        var kembalian = document.getElementById("kembalian");
        cash.addEventListener("keyup", function (e) {
            cash.value = convertRupiah(this.value, "Rp. ");
        });
        cash.addEventListener('keydown', function (event) {
            return isNumberKey(event);
        });

        $(document).ready(function () {
            $(document).on('change', '#cash', function(e) {
                e.preventDefault();
                let cash = $(this).val();
                var cash2 = cash.toUpperCase();
                var duit = cash2.replace(/[^\w\s]/gi, '');
                var duit2 = duit.replace(/\s/g, '');
                var duit3 = duit2.replace(/[^0-9]/, '');
                var duit4 = duit3.substr(1);
                let total = $('#grand_total').val();
                let kembali = duit4 - total;
                $('#kembalian').html('Rp. ' + kembali);
                $('#buat-pesanan').removeClass('btn-dark');
                $('#buat-pesanan').addClass('btn-success');
                $('#buat-pesanan').prop("disabled", false);
            });
        });
    </script>
    @endpush
@endsection