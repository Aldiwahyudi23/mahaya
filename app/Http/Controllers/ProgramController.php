<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\program;
use App\Models\User;

class ProgramController extends Controller
{
    public function index () {
        $data_program = program::orderByRaw('created_at DESC')->get();
        $data_pengurus = Pengurus::orderByRaw('nama_pengurus DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();

        return view('admin.master_data.program.index',compact('data_program','data_anggota','data_pengurus'));
    }

    public function tambah(Request $request) {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_program = new program();
        $data_program->nama_anggaran          = $request->input('nama_program');
        $data_program->program_id             = $request->input('pengurus_id');
        $data_program->save();
        $program = program::find($data_program->id);
        return redirect()->back()->with('sukses', 'Data Program Parantos Ka tambahkeun kana data');
    }

    public function edit($id) {
        $data_program = program::orderByRaw('created_at DESC')->get();
        $data_pengurus = Pengurus::orderByRaw('nama_pengurus ASC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $program = program::find($id);

        return view('admin.master_data.program.edit',compact('data_anggota','data_pengurus','data_program','program'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
          'jumlah' => 'numeric',
       ]);
      $program = program::find($id);
      $program->update($request->all());
      $program->save();
       return redirect('program')->with('sukses', 'Data program Kas atos tiasa di edit');
    }

    public function detail($id) {
        $program = program::find($id);

        return view('admin.master_data.program.detail',compact('program'));
    }
            //function untuk hapus
    public function hapus($id)
    {
        $program = program::find($id);
        $program->delete();
        return redirect('program')->with('sukses', 'Data program Atos Dihapus');
    }
}