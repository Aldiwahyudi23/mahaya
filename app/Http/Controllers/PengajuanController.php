<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\program;
use App\Models\Anggaran;
use App\Models\User;
use App\Models\Bayar_Pinjam;
use Twilio\Rest\Client; 

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

        $data_setor->pembayaran             = $request->input('pembayaran');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->kategori            = 'Bayar';
        $data_setor->anggota_id            = Auth::id();
        $data_setor->save();
        $setor = Pengajuan::find($data_setor->id);

//         $sid    = ""; 
//         $token  = ""; 
//         $twilio = new Client($sid, $token); 
         
//         $message = $twilio->messages 
//                           ->create("whatsapp:+6281312716522", // to 
//                                    array( 
//                                        "from" => "whatsapp:+14155238886",       
//                                        "body" => "Informasi !!!

// Punten ka bendahara, aya nu bayar uang kas mangga konfirmasi heula supados raosen kana manahna.

// Pembayaran : {$request->pembayaran}
// Ket : {$request->keterangan}
// Jumlah na : {$request->jumlah} 

// Konfirmasi ayeuna klik wae link  ieu http://kaskeluarga.royaldi21.com/pengajuan/setor/anggota/",
//                                    ) 
//                           ); 

 
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

        // Deskripsi anggaran
        $anggaran_darurat = Anggaran::first('deskripsi');
        $anggaran_amal = Anggaran::first('deskripsi');
        $anggaran_usaha = Anggaran::first('deskripsi');
        $anggaran_acara = Anggaran::where('nama_anggaran',5)->get();
        $anggaran_lain = Anggaran::where('nama_anggaran',6)->get();

        return view('anggota.pinjam',compact('data_tarik','dana_darurat','dana_amal','data_pinjam','dana_usaha','dana_acara','dana_lain','anggaran_darurat','anggaran_amal','anggaran_usaha','anggaran_acara','anggaran_lain'));
    }

    public function pinjam_tambah(Request $request)
    {
        $jumlah_pemasukan = DB::table('pemasukan')
        ->sum('pemasukan.jumlah');
        $jumlah_pemasukan_asli = $jumlah_pemasukan - 362500; //Jumlah semua pemasukan
        $pinjam = $jumlah_pemasukan_asli * 20 / 100; // Menghitung Jumlah anggaran pinjaman dari semua pemasukan
        $jatah = $pinjam * 30 / 100;

        $pengajuan = Pengajuan::first('anggota_id',Auth::user()->id);
        $pengajuan_total = Pengajuan::where('id')->count();

        $request->validate([
            'jumlah' => 'numeric',
        ]);

        if ($request->input('jumlah') <= $jatah ) 
        {
            if ($pengajuan_total <= 6)
            {
            $data_setor = new Pengajuan();
    
            $data_setor->tanggal             = $request->input('tanggal');
            $data_setor->jumlah              = $request->input('jumlah');
            $data_setor->keterangan          = $request->input('keterangan');
            $data_setor->kategori            = '3';
            $data_setor->pembayaran            = 'Pinjam';
            $data_setor->anggota_id            = Auth::id();
            $data_setor->save();
            $setor = Pengajuan::find($data_setor->id);
    
    //         $sid    = ""; 
    //         $token  = ""; 
    
    //         $twilio = new Client($sid, $token); 
    
    //         $message = $twilio->messages 
    //                           ->create("whatsapp:+6281312716522", // to 
    //                                    array( 
    //                                        "from" => "whatsapp:+14155238886",       
    //                                        "body" => "Informasi Peminjaman!!!
    
    // Punten ka bendahara, aya nu bade nambut uang kas. Mangga rundingkeun sareng pengurus nu sanes supados kenging titik tengah
     
    // Jumlah na : {$request->jumlah} 
    // Alasan : {$request->keterangan}
     
    // Konfirmasi ayeuna klik wae link  ieu http://kaskeluarga.royaldi21.com/pengajuan/tarik/anggota/",
    //                                    ) 
    //                           ); 
    
            return redirect()->back()->with('sukses', 'Peminjaman anu nembe di input bade di konfirmasi heula ku pihak pengurus, bade ningal heula kondisi saldo sareng di tinjau heula alsanna. ');
                }else{
                    return redirect()->back()->with('warning', 'Anjen atos gaduh pengajuan anu nuju di proses, Antosan proses na nuju di badamikeun');
                }

            }else{
                return redirect()->back()->with('warning', 'Punten, Nominal atau Jumlah pengajuan pinjaman kedah 30 % ti total jumlah anggaran Pinjaman.');
            }

    }

    // bayar pinjam
    public function bayar_pinjaman($id)
    {
        $data_setor = Pengeluaran::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $setor = Pengeluaran::find($id);
        $bayar_pinjam = Bayar_Pinjam::where('pengeluaran_id', $id)->get();

        return view('admin.pemasukan.bayar_pinjam', compact('setor', 'data_setor', 'data_anggota', 'bayar_pinjam'));
    }


    public function bayar_pinjam_tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
            $data_bayar = new Pengajuan();
            $data_bayar->pembayaran          = $request->input('pembayaran');
            $data_bayar->kategori             = 'Bayar_pinjaman';
            $data_bayar->pengeluaran_id       = $request->input('pengeluaran_id');
            $data_bayar->jumlah              = $request->input('jumlah');
            $data_bayar->keterangan              = $request->input('keterangan');
            $data_bayar->proses              = $request->input('proses');
            $data_bayar->lama              = $request->input('lama');
            $data_bayar->anggota_id            = Auth::id();
            $data_bayar->save();
            $bayar = Pengajuan::find($data_bayar->id);
    
            return redirect()->back()->with('sukses', 'Pembayaran dana pinjaman atos masuk, kantun ngantosan di konfirmasi ku bendahara');

    }
}
