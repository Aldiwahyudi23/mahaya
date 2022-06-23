<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::first();
        return view('admin/pengumuman', compact('pengumuman'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'isi' => 'required',
        ]);

        Pengumuman::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'isi' => $request->isi,
            ]
        );

        return redirect()->back()->with('sukses', 'Pengumuman berhasil di perbarui!');
    }
}
