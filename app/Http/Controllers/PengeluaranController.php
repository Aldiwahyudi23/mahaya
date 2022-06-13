<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use App\Models\Anggaran;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index () {
        $data_tarik = Pengeluaran::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $data_anggaran = Anggaran::orderByRaw('nama ASC')->get();

        $dana_darurat = Pengeluaran::where('anggaran_id',1)->get();
        $dana_amal = Pengeluaran::where('anggaran_id',2)->get();
        $dana_pinjam = Pengeluaran::where('anggaran_id',3)->get();
        $dana_usaha = Pengeluaran::where('anggaran_id',4)->get();
        $dana_acara = Pengeluaran::where('anggaran_id',5)->get();
        $dana_lain = Pengeluaran::where('anggaran_id',6)->get();

        return view('admin.pengeluaran.index',compact('data_tarik','data_anggota','data_anggaran','dana_darurat','dana_amal','dana_pinjam','dana_usaha','dana_acara','dana_lain'));
    }

    // Admin
    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pengeluaran();
        $data_setor->anggota_id          = $request->input('anggota_id');
        $data_setor->anggaran_id          = $request->input('anggaran_id');
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->pengurus_id            = Auth::id();
        $data_setor->save();
        $setor = Pengeluaran::find($data_setor->id);
        return redirect()->back()->with('sukses', 'Penarikan uang kas paratos di input mangga wae candak artosna');
        // return view('/tabungan/setor/cetak', compact('setor'));
    }
}
