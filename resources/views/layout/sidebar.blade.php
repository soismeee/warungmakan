<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('owner')
                <li>
                    <a href="{{ route('usr.index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-briefcase"></i></div>
                        <span>User Pengguna</span>
                    </a>
                </li>    
                

                <li class="menu-title">Data Master</li>

                <li>
                    <a href="{{ route('ma.index') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                        <span>Makanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mi.index') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                        <span>Minuman</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jb.index') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-grids"></i></div>
                        <span>Jus Buah</span>
                    </a>
                </li>

                <li class="menu-title">Data Penjualan</li>

                <li>
                    <a href="{{ route('ip') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-window-grid"></i></div>
                        <span>Input Penjualan</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-document-layout-left"></i></div>
                        <span>Transaksi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('p') }}">Data Transaksi</a></li>
                        <li><a href="{{ route('rl') }}">Rekap Laporan</a></li>
                    </ul>
                </li>
                @endcan
                
                @can('karyawan')
                
                <li class="menu-title">Data Penjualan</li>

                <li>
                    <a href="{{ route('ip') }}" class=" waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-window-grid"></i></div>
                        <span>Input Penjualan</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-document-layout-left"></i></div>
                        <span>Transaksi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('p') }}">Data Transaksi</a></li>
                    </ul>
                </li>
                @endcan

                <li>
                    <a href="#" class=" waves-effect" data-toggle="modal" data-target="#ModalLogout">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-sign-out-alt"></i></div>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<!--  Modal logout -->
<div class="modal fade ModalLogout" id="ModalLogout" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Keluar aplikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin keluar?
            </div>
            <form action="{{ route('logout') }}" method="post">
            @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Keluar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->