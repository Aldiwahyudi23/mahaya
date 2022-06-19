<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengurus;
use App\Models\program;
use App\Models\User;

class PengurusController extends Controller
{
    public function index () {
        $data_pengurus = pengurus::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();

        return view('admin.master_data.pengurus.index',compact('data_pengurus','data_anggota'));
    }

    public function tambah(Request $request) {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_pengurus = new pengurus();
        $data_pengurus->nama_pengurus          = $request->input('nama_pengurus');
        $data_pengurus->deskripsi              = $request->input('deskripsi');
        $data_pengurus->save();
        $pengurus = pengurus::find($data_pengurus->id);
        return redirect()->back()->with('sukses', 'Data pengurus Parantos Ka tambahkeun kana data');
    }

    public function edit($id) {
        $data_pengurus = pengurus::orderByRaw('created_at DESC')->get();
        $data_pengurus = Pengurus::orderByRaw('nama_pengurus ASC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $pengurus = pengurus::find($id);

        return view('admin.master_data.pengurus.edit',compact('data_anggota','data_pengurus','data_pengurus','pengurus'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
          'jumlah' => 'numeric',
       ]);
      $pengurus = pengurus::find($id);
      $pengurus->update($request->all());
      $pengurus->save();
       return redirect('pengurus')->with('sukses', 'Data pengurus Kas atos tiasa di edit');
    }

    public function detail($id) {
        $pengurus = pengurus::find($id);

        return view('admin.master_data.pengurus.detail',compact('pengurus'));
    }
            //function untuk hapus
    public function hapus($id)
    {
        $pengurus = pengurus::find($id);
        $pengurus->delete();
        return redirect('pengurus')->with('sukses', 'Data pengurus Atos Dihapus');
    }
}
