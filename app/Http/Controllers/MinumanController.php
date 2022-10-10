<?php

namespace App\Http\Controllers;

use App\Models\Kodes;
use App\Models\Minuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MinumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kode = Minuman::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
        $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'MI')->first();
        $kode_minuman = new Minuman();
        $kode_minuman->kodes = 'MI' . $kode->kodes;
        return view('data_master.minuman.index', [
            'title' => 'Menu Minuman',
            'kode' => $kode_minuman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Minuman::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function (Minuman $data) {
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
            $minuman = new Minuman();
            $minuman->id = $request->id;
            $minuman->nama = $request->nama;
            $minuman->harga = preg_replace('/[^0-9]/', '', $request->harga);
            $minuman->keterangan = $request->keterangan;
            $minuman->save();

            $kode = new Kodes();
            $kode->name = $request->id;
            $kode->kode = "MI";
            $kode->save();

            // $kode = Minuman::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
            $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'MI')->first();
            $kode_minuman = new Minuman();
            $kode_minuman->kodes = 'MI' . $kode->kodes;
            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'kode' => $kode_minuman
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
        $minuman = Minuman::find($id);
        if ($minuman) {
            return response()->json([
                'status' => 200,
                'data' => $minuman
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
            // $kode = Minuman::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
            $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'MI')->first();
            $kode_minuman = new Minuman();
            $kode_minuman->kodes = 'MI' . $kode->kodes;

            $minuman = Minuman::find($id);
            if ($minuman) {
                $minuman->nama = $request->nama;
                $minuman->harga = preg_replace('/[^0-9]/', '', $request->harga);
                $minuman->keterangan = $request->keterangan;
                $minuman->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                    'kode' => $kode_minuman
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak berhasil diambil',
                    'kode' => $kode_minuman
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
        Minuman::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
