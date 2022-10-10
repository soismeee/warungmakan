<?php

namespace App\Http\Controllers;

use App\Models\RekapPenjualan;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        $transaksi_harian = TransaksiPenjualan::where('tanggal', '=', date('Y-m-d'))->get();
        $laba_harian = 0;
        foreach ($transaksi_harian as $item1) {
            $laba_harian += $item1->total_bayar;
        }
        
        $transaksi_bulanan = TransaksiPenjualan::latest()->whereMonth('tanggal', '=', date('m'))->whereYear('tanggal', '=', date('Y'))->get();
        $laba_bulan = 0;
        foreach ($transaksi_bulanan as $item2) {
            $laba_bulan += $item2->total_bayar;
        }

        $belanja_bulanan = RekapPenjualan::latest()->whereMonth('tanggal', '=', date('m'))->whereYear('tanggal', '=', date('Y'))->get();
        $pendapatan = 0;
        $laba = 0;
        $belanja = 0;
        foreach ($belanja_bulanan as $item3) {
            $pendapatan += $item3->pendapatan;
            $belanja += $item3->belanja;
            $laba += $item3->laba;
        }

        return view('index', [
            'title' => 'Menu Utama',
            'jumlah' => TransaksiPenjualan::latest()->where('tanggal', '=', date('Y-m-d'))->get(),
            'harian' => $laba_harian,
            'bulanan' => $laba_bulan,

            'pendapatan' => $pendapatan,
            'belanja' => $belanja,
            'laba' => $laba
        ]);
    }

    public function profil(){
        return view('layout.profil',[
            'title' => 'Profil pengguna'
        ]);
    }

    public function update(Request $request, $id){
        // dd($request);
        $rules = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
        ]);

        if ($request->password) {
            $rules['password'] = Hash::make($request->password);
        }
        User::where('id', $id)->update($rules);
        
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'Data user berhasil diubah!!');
    }
}
