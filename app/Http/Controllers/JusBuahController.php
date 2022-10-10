<?php

namespace App\Http\Controllers;

use App\Models\JusBuah;
use App\Models\Kodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JusBuahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kode = JusBuah::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
        $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'JB')->first();
        $kode_jusbuah = new JusBuah();
        $kode_jusbuah->kodes = 'JB' . $kode->kodes;
        return view('data_master.jus_buah.index', [
            'title' => 'Menu Jus Buah',
            'kode' => $kode_jusbuah
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = JusBuah::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function(JusBuah $data){
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
            $jusbuah = new JusBuah();
            $jusbuah->id = $request->id;
            $jusbuah->nama = $request->nama;
            $jusbuah->harga = preg_replace('/[^0-9]/', '', $request->harga);
            $jusbuah->keterangan = $request->keterangan;
            $jusbuah->save();

            $kode = new Kodes();
            $kode->name = $request->id;
            $kode->kode = "JB";
            $kode->save();

            // $kode = JusBuah::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
            $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'JB')->first();
            $kode_jusbuah = new JusBuah();
            $kode_jusbuah->kodes = 'JB' . $kode->kodes;
            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'kode' => $kode_jusbuah
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
        $jusbuah = Jusbuah::find($id);
        if($jusbuah){
            return response()->json([
                'status' => 200,
                'data' => $jusbuah
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
            // $kode = JusBuah::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->first();
            $kode = Kodes::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('kode', 'JB')->first();
            $kode_jusbuah = new JusBuah();
            $kode_jusbuah->kodes = 'JB' . $kode->kodes;
            
            $jusbuah = JusBuah::find($id);
            if ($jusbuah) {
                $jusbuah->nama = $request->nama;
                $jusbuah->harga = preg_replace('/[^0-9]/', '', $request->harga);
                $jusbuah->keterangan = $request->keterangan;
                $jusbuah->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                    'kode' => $kode_jusbuah
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak berhasil diambil',
                    'kode' => $kode_jusbuah
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
        JusBuah::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
