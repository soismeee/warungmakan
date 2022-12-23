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
                        <h4 class="page-title mb-1">User Pengguna</h4>
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
                                    <div class="form-group form-group-custom mb-3">
                                        <input type="hidden" id="id" name="id">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                        <label for="name">Nama Pengguna</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-custom">
                                                <input type="text" class="form-control" name="username" id="username" required>
                                                <label for="username">Username</label> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-custom">
                                                <input type="password" class="form-control" name="password" id="password" required>
                                                <label for="userpassword">Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-info waves-effect waves-light" style="display: none" id="update-pengguna">Ubah Pengguna</button>
                                        <button class="btn btn-primary waves-effect waves-light" id="add-pengguna">Tambah Pengguna</button>
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
                                        <th width="30%">Username</th>
                                        <th width="20%">Role</th>
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

    <!-- Modal hapus -->
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
            ajax: "{{ route('usr.create') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'role', name: 'role' },
                { data: 'action'},
            ]
        });
    }

    $(document).on('click', '#add-pengguna', function(e){
        e.preventDefault();
        
        var data = {'name': $('#name').val(), 'username': $('#username').val(),'password': $('#password').val(), '_token': '{{ csrf_token() }}'};
        $.ajax({
            type: "POST",
            url: "{{ route('usr.index') }}",
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
                    $('#name').val(null);
                    $('#username').val(null);
                    $('#password').val(null);
                }
            }
        });
    });

    $(document).on('click', '#edit-data', function(e){
        e.preventDefault();
        var id = $(this).val();
        $('#update-pengguna').show();
        $('#add-pengguna').hide();
        $.ajax({
            type: "GET",
            url: "{{ route('usr.index') }}/"+id,
            success: function (response){
                if (response.status == 401) {
                    $('#success_message').addClass('alert alert-warning');
                    $('#success_message').text(response.errors);
                }else{
                    $('#id').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#username').val(response.data.username);
                }
            }
        });
    });

    $(document).on('click', '#update-pengguna', function(e){
        e.preventDefault();
        var data = {'name': $('#name').val(), 'username': $('#username').val(), 'password': $('#password').val(), '_token': '{{ csrf_token() }}'};
        var id = $('#id').val();
        $.ajax({
            type: "PUT",
            url: "{{ route('usr.index') }}/"+id,
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
                    $('#name').val(null);
                    $('#username').val(null);
                    $('#keterangan').val(null);
                    $('#update-pengguna').hide();
                    $('#add-pengguna').show();
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
            url: "{{ route('usr.index') }}/" + id,
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
            url: "{{ route('usr.index') }}/" + id,
            data: {'_token': '{{ csrf_token() }}'},
            dataType: 'json',
            success: function (response){
                $('#modalHapus').modal('hide');
                $('.success_message').addClass('alert alert-success');
                $('.success_message').html('Data pengguna berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button>');
                $('#data-table').DataTable().ajax.reload();
            }
        });
    });
    </script>
    @endpush
@endsection