<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\program;

class PengajuanController extends Controller
{
    public function bayar () {

        $data_setor = Pemasukan::where('anggota_id', Auth::user()->id)->orderBy('anggota_id')->get();
        $data_program = program::orderByRaw('created_at DESC')->get();
        $program = program::where('id')->get();

        return view('anggota.bayar',compact('data_setor','program'));
    }

    public function bayar_tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pengajuan();

        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->kategori            = 'Bayar';
        $data_setor->anggota_id            = Auth::id();
        $data_setor->save();
        $setor = Pengajuan::find($data_setor->id);
        return redirect()->back()->with('sukses', 'Data pembayaran uang kas anu nembe parantos di input teu acan tiasa lebet kana Pendataan. Data bakal lebet saatos di konfirmasi ku bendahara sesuai keterangan anu di input  ');

    }
    public function pinjam () {
        $data_tarik = Pengeluaran::orderByRaw('created_at DESC')->get();

        $data_pinjam = Pengeluaran::where('anggota_id', Auth::user()->id)->orderBy('anggota_id')->get();
        $dana_darurat = Pengeluaran::where('anggaran_id',1)->get();
        $dana_amal = Pengeluaran::where('anggaran_id',2)->get();
        $dana_usaha = Pengeluaran::where('anggaran_id',4)->get();
        $dana_acara = Pengeluaran::where('anggaran_id',5)->get();
        $dana_lain = Pengeluaran::where('anggaran_id',6)->get();

        return view('anggota.pinjam',compact('data_tarik','dana_darurat','dana_amal','data_pinjam','dana_usaha','dana_acara','dana_lain'));
    }

    public function pinjam_tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pengajuan();

        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->kategori            = '3';
        $data_setor->anggota_id            = Auth::id();
        $data_setor->save();
        $setor = Pengajuan::find($data_setor->id);
        return redirect()->back()->with('sukses', 'Peminjaman anu nembe di input bade di konfirmasi heula ku pihak pengurus, bade ningal heula kondisi saldo sareng di tinjau heula alsanna. ');

    }
}
