<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pemasukan;
use App\Models\Pengajuan;
use App\Models\Pengeluaran;
use App\Models\program;

class PemasukanController extends Controller
{
    public function index () {
        $data_setor = Pemasukan::where('anggota_id', Auth::user()->id)->orderBy('anggota_id')->get();
        $data_semua = Pemasukan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        return view('admin.pemasukan.index',compact('data_setor','data_anggota','data_semua'));
    }

// Admin
    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pemasukan();
        $data_setor->anggota_id          = $request->input('anggota_id');
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->pengurus_id            = Auth::id();
        $data_setor->save();
        $setor = Pemasukan::find($data_setor->id);
        return redirect()->back()->with('sukses', 'Data Setor Kas Parantos Ka tambahkeun kana data');
        // return view('/tabungan/setor/cetak', compact('setor'));
    }

      //function untuk masuk ke view edit
    public function edit($id)
    {
        $data_setor = Pemasukan::where('anggota_id', Auth::user()->id)->orderBy('anggota_id')->get();
        $data_semua = Pemasukan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $setor = Pemasukan::find($id);
        return view('/admin/pemasukan/edit', compact('setor','data_setor','data_anggota','data_semua'));
    }
      
    public function update(Request $request, $id)
    {
       $request->validate([
          'jumlah' => 'numeric',
       ]);
      $setor = Pemasukan::find($id);
      $setor->update($request->all());
      $setor->save();
       return redirect('/pemasukan/setor')->with('sukses', 'Data Setor Kas atos tiasa di edit');
    }
            //function untuk hapus
    public function hapus($id)
    {
        $setor = Pemasukan::find($id);
        $setor->delete();
        return redirect('/pemasukan/setor')->with('sukses', 'Data Setor Tunai Atos Dihapus');
    }
// End Admin

// Pengajuan
    public function pengajuan () {
        $data_pengajuan = Pengajuan::where('kategori','Bayar')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        return view('admin.pemasukan.pengajuan',compact('data_pengajuan','data_anggota'));
    }
    public function pengajuan_lihat ($id) {
        $data_setor = Pengajuan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $setor = Pengajuan::find($id);

        return view('admin.pemasukan.pengajuan_lihat', compact('setor','data_setor','data_anggota'));
    }

  
    public function pengajuan_tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pemasukan();
        $data_setor->anggota_id          = $request->input('anggota_id');
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->pengurus_id            = Auth::id();
        $data_setor->save();
        $setor = Pemasukan::find($data_setor->id);
        // sekalian hapus data
        $pengajuan = Pengajuan::find($request->id_pengajuan);
        $pengajuan->delete();

        return redirect('/pengajuan/setor/anggota')->with('sukses', 'Data Pembayaran Kas Parantos Ka tambahkeun kana data');
    }

}
