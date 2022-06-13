<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;


class PemasukanController extends Controller
{
    public function index () {
        $data_setor = Pemasukan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        return view('admin.pemasukan.index',compact('data_setor','data_anggota'));
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
    public function edit($id_setor)
    {
        $setor = Pemasukan::find($id_setor);
        return view('/pemasukan/setor/edit', compact('setor'));
    }
      
    public function update(Request $request, $id_setor)
    {
       $request->validate([
          'jumlah' => 'numeric',
       ]);
      $setor = Pemasukan::find($id_setor);
      $setor->update($request->all());
      $setor->save();
       return redirect('/pemasukan/setor')->with('sukses', 'Data Setor Kas atos tiasa di edit');
    }
            //function untuk hapus
    public function delete($id)
    {
        $setor = Pemasukan::find($id);
        $setor->delete();
        return redirect('/pemasukan/setor')->with('sukses', 'Data Setor Tunai Berhasil Dihapus');
    }
// End Admin
}
