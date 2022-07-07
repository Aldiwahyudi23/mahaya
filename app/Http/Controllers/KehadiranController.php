<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::all();

        return view('home',compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'kehadiran'     => 'required',
                'siapa'  => 'required',
                
            ],
            [
                'kehadiran.required'        => "Kehadiran kedah di isi kanggo epaluasi kanggo ke acara.",
                'siapa.required'        => "teu kengeng kosong, Esian sesuai contoh. saha wae anu tiasa atawa anu teu tiasa ngiringan.",

            ]
        );
        $data_setor = new Kehadiran();
        $data_setor->tanggapan          = $request->input('tanggapan');
        $data_setor->kehadiran             = $request->input('kehadiran');
        $data_setor->siapa              = $request->input('siapa');
        $data_setor->alasan          = $request->input('alasan');
        $data_setor->anggota_id            = Auth::id();
        $data_setor->save();
        $setor = Kehadiran::find($data_setor->id);

        $status = User::find(Auth::id());
        $status_ = [
            'pengumuman_id' => 2
        ];
        $status->update($status_);
        
            if ($request->input('kehadiran') == 'Hadir')
            {
                
                    return redirect()->back()->with('sukses', 'Hatur nuhun parantos kasadianana kanggo acara keluarga ieu, di mana acara ieu teh anu ku urang di pikahoyong. teu tiasa seer saur mung tiasa ngahatur nuhunkrun sa agengna gunung HARUMAN bakal jadi saksi bahwa keluarga urang teh rukun sauyunan Buktikeun keluarga urang bisa jeung mampu kana sagala kahadean, boh pribadi atanapi kanggo umum. Da URANG MAH TURUNAN PAJAJARAN SARENG SILIWANGI');
            } else {
                    return redirect()->back()->with('warning', 'Hatur nuhun parantos kersa nguninga kana pesan ieu, mugia urang di parinan kasehatan tur kasalametan dimanawae urang ayana. Hapunten nyuhunkeun di hapunten pami tina acara ieu teu acan tiasa optimal, di mana teu tiasa hadirna anjen di acara ieu mun tina acara iu bertepatan sareng kasibukan pribadi. tapi insya Allah kanggo kapayunna boh tina acara atanapi kasibukan pribadina, teu tiasa seer saur mung tiasa ngahatur nuhunkrun sa agengna gunung HARUMAN bakal jadi saksi bahwa keluarga urang teh rukun sauyunan Buktikeun keluarga urang bisa jeung mampu kana sagala kahadean, boh pribadi atanapi kanggo umum. Da URANG MAH TURUNAN PAJAJARAN SARENG SILIWANGI');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
