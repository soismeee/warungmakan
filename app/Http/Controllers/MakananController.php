<?php

namespace App\Http\Controllers;

use App\Models\Kodes;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kode = Makanan::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
        $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'MA')->first();
        $kode_makanan = new Makanan();
        $kode_makanan->kodes = 'MA' . $kode->kodes;
        return view('data_master.makanan.index', [
            'title' => 'Menu Makanan',
            'kode' => $kode_makanan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Makanan::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function(Makanan $data){
                return view('data_master.action', [
                    'data' => $data
                ]);
            })->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required',
            'nama' => 'required|max:255',
            'harga' => 'required|max:255',
            'keterangan' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => 'Data tidak bisa di inputkan',
            ]);
        } else {
            $makanan = new Makanan();
            $makanan->id = $request->id;
            $makanan->nama = $request->nama;
            $makanan->harga = preg_replace('/[^0-9]/', '', $request->harga);
            $makanan->keterangan = $request->keterangan;
            $makanan->save();

            $kode = new Kodes();
            $kode->name = $request->id;
            $kode->kode = "MA";
            $kode->save();

            // $kode = Makanan::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
            $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'MA')->first();
            $kode_makanan = new Makanan();
            $kode_makanan->kodes = 'MA' . $kode->kodes;
            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'kode' => $kode_makanan,
            ]);
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
        $makanan = Makanan::find($id);
        if($makanan){
            return response()->json([
                'status' => 200,
                'data' => $makanan
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validate = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'harga' => 'required|max:255',
            'keterangan' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => 'Data tidak bisa di ubah',
            ]);
        } else {
            // $kode = Makanan::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
            $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'MA')->first();
            $kode_makanan = new Makanan();
            $kode_makanan->kodes = 'MA' . $kode->kodes;
            
            $makanan = Makanan::find($id);
            if ($makanan) {
                $makanan->nama = $request->nama;
                $makanan->harga = preg_replace('/[^0-9]/', '', $request->harga);
                $makanan->keterangan = $request->keterangan;
                $makanan->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                    'kode' => $kode_makanan,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak berhasil diambil',
                    'kode' => $kode_makanan,
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Makanan::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
