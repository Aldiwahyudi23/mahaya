<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggaran;
use App\Models\program;
use App\Models\User;

class AnggaranController extends Controller
{
    public function index () {
        $data_anggaran = Anggaran::orderByRaw('created_at DESC')->get();
        $data_program = program::orderByRaw('nama_program ASC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();

        return view('admin.master_data.anggaran.index',compact('data_anggaran','data_anggota','data_program'));
    }

    public function tambah(Request $request) {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_anggaranr = new Anggaran();
        $data_anggaranr->nama_anggaran          = $request->input('nama_anggaran');
        $data_anggaranr->program_id             = $request->input('program_id');
        $data_anggaranr->deskripsi              = $request->input('deskripsi');
        $data_anggaranr->save();
        $anggaranr = Anggaran::find($data_anggaranr->id);
        return redirect()->back()->with('sukses', 'Data Anggaran Parantos Ka tambahkeun kana data');
    }

    public function edit($id) {
        $data_anggaran = Anggaran::orderByRaw('created_at DESC')->get();
        $data_program = program::orderByRaw('nama_program ASC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $anggaran = Anggaran::find($id);

        return view('admin.master_data.anggaran.edit',compact('data_anggaran','data_anggota','data_program','anggaran'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
          'jumlah' => 'numeric',
       ]);
      $anggaran = Anggaran::find($id);
      $anggaran->update($request->all());
      $anggaran->save();
       return redirect('anggaran')->with('sukses', 'Data anggaran Kas atos tiasa di edit');
    }

    public function detail($id) {
        $anggaran = Anggaran::find($id);

        return view('admin.master_data.anggaran.detail',compact('anggaran'));
    }
            //function untuk hapus
    public function hapus($id)
    {
        $anggaran = Anggaran::find($id);
        $anggaran->delete();
        return redirect('anggaran')->with('sukses', 'Data anggaran Tunai Atos Dihapus');
    }
}
