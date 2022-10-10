<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiPenjualan;
use App\Models\JusBuah;
use App\Models\Makanan;
use App\Models\Minuman;
use App\Models\RekapPenjualan;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TransPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.index', [
            'title' => 'Data Transaksi'
        ]);
    }

    public function json()
    {
        $query = TransaksiPenjualan::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal', function(TransaksiPenjualan $data){
                return view('transaksi.field.tanggal', [
                    'data' => $data
                ]);
            })
            ->addColumn('kembalian', function(TransaksiPenjualan $data){
                return view('transaksi.field.kembalian', [
                    'data' => $data
                ]);
            })
            ->addColumn('action', function(TransaksiPenjualan $data){
                return view('transaksi.field.action', [
                    'data' => $data
                ]);
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = TransaksiPenjualan::selectRaw('LPAD(CONVERT(COUNT("no_trans") + 1, char(8)) , 3,"0") as kodes')->first();
        $kode_pesanan = new TransaksiPenjualan();
        $kode_pesanan->kodes = 'TPN' . $kode->kodes;
        return view('transaksi.create', [
            'title' => 'Input Penjualan',
            'makanan' => Makanan::all(),
            'minuman' => Minuman::all(),
            'jusbuah' => JusBuah::all(),
            'kode' => $kode_pesanan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validate = Validator::make($request->all(), [
            'nama_pesanan' => 'required',
            'harga' => 'required',
            'jumlah' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect('/ip')->with('error', 'Mohon maaf, proses transaksi tidak berhasil, pastikan semua data terisi!!!');
        } else {
            if($request->id_pesanan){
                $jumlah = $request->jumlah;
                $harga = $request->harga;
                $menu = $request->menu;

                foreach ($request->id_pesanan as $key => $pesanan) {
                    DetailTransaksiPenjualan::create([
                        'no_trans' => $request->no_trans,
                        'nama_pesanan' => $request->nama_pesanan[$key],
                        'menu' => $menu[$key],
                        'jumlah' => $jumlah[$key],
                        'harga' => $harga[$key],
                        'total_harga' => $jumlah[$key] * $harga[$key],
                    ]);
                }
            }

            $trans = new TransaksiPenjualan();
            $trans->no_trans = $request->no_trans;
            // $trans->user_id = auth()->user()->id;
            $trans->user_id = 1;
            $trans->tanggal = date(now());
            $trans->total_bayar = $request->grand_total;
            $trans->uang_kembali = preg_replace('/[^0-9]/', '', $request->cash);
            $trans->save();
            // return redirect('/p');
            return redirect('/dp/'.$request->no_trans);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('transaksi.detail', [
            'title' => 'Detail Data Pesanan',
            'data' => TransaksiPenjualan::find($id),
            'detail' => DetailTransaksiPenjualan::where('no_trans', $id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = TransaksiPenjualan::find($id);
        if($transaksi){
            return response()->json([
                'status' => 200,
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiPenjualan::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil dihapus',
        ]);
    }

    public function cetak($id){
        return view('transaksi.struk', [
            'title' => "Cetak Struk $id",
            'data' => TransaksiPenjualan::find($id),
            'detail' => DetailTransaksiPenjualan::where('no_trans', $id)->get()
        ]);
    }

    ###############################################################################################################################################
    public function rekap()
    {

        return view('transaksi.rekap', [
            'title' => 'Rekap Penjualan',
            'data' => RekapPenjualan::where('tanggal', '=', date('Y-m-d'))->get(),
            'rekap' => DetailTransaksiPenjualan::whereDate('created_at', date('Y-m-d'))->get(),
            'total' => 0
        ]);
    }

    public function rekap_harian()
    {
        $query = TransaksiPenjualan::where('tanggal', '=', date('Y-m-d'))->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal', function(TransaksiPenjualan $data){
                return view('transaksi.field.tanggal', [
                    'data' => $data
                ]);
            })->make(true);
    }

    public function save(Request $request){
        $validate = $request->validate([
            'pendapatan' => 'required',
            'belanja' => 'required',
        ]);

        $pendapatan = preg_replace('/[^0-9]/', '', $request->pendapatan);
        $belanja = preg_replace('/[^0-9]/', '', $request->belanja);
        $laba = $pendapatan-$belanja;

        $rekap = new RekapPenjualan();
        $rekap->pendapatan = $pendapatan;
        $rekap->belanja = $belanja;
        $rekap->laba = $laba;
        $rekap->tanggal = date(now());
        $rekap->save();
        return response()->json([
            'status' => 200,
            'data' => $rekap
        ]);
        // return redirect('/rl')->with('success', 'Rekap data berhasil dilakukan');
    }

    public function json_rekap(){
        $query = RekapPenjualan::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal', function(RekapPenjualan $data){
                return view('transaksi.field.tanggal', [
                    'data' => $data
                ]);
            })
            ->addColumn('action', function(RekapPenjualan $data){
                return view('transaksi.field.action_rekap', [
                    'data' => $data
                ]);
            })->make(true);
    }

    public function rekap_show($id){
        $rekap = RekapPenjualan::find($id);
        if($rekap){
            return response()->json([
                'status' => 200,
                'data' => $rekap
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }

    public function update_rekap(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'pendapatan' => 'required|max:255',
            'belanja' => 'required|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => 'Data tidak bisa di ubah',
            ]);
        } else {

            $rekap = RekapPenjualan::find($id);
            if ($rekap) {
                $pendapatan = preg_replace('/[^0-9]/', '', $request->pendapatan);
                $belanja = preg_replace('/[^0-9]/', '', $request->belanja);
                $laba = $pendapatan-$belanja;

                $rekap->pendapatan = $pendapatan;
                $rekap->belanja = $belanja;
                $rekap->laba = $laba;
                $rekap->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak berhasil diambil'
                ]);
            }
        }
    }
}
