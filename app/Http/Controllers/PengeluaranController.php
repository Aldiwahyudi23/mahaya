<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use App\Models\Anggaran;
use App\Models\Pemasukan;
use App\Models\Pengajuan;
use App\Models\Bayar_Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client; 

class PengeluaranController extends Controller
{
    public function index () {
        $data_tarik = Pengeluaran::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $data_anggaran = Anggaran::orderByRaw('nama_anggaran ASC')->get();
        $data_pinjam = Pengeluaran::where('anggota_id', Auth::user()->id)->orderBy('anggota_id')->get();

        $dana_darurat = Pengeluaran::where('anggaran_id',1)->get();
        $dana_amal = Pengeluaran::where('anggaran_id',2)->get();
        $dana_pinjam = Pengeluaran::where('anggaran_id',3)->get();
        $dana_usaha = Pengeluaran::where('anggaran_id',4)->get();
        $dana_acara = Pengeluaran::where('anggaran_id',5)->get();
        $dana_lain = Pengeluaran::where('anggaran_id',6)->get();

        return view('admin.pengeluaran.index',compact('data_tarik','data_anggota','data_anggaran','dana_darurat','dana_amal','dana_pinjam','dana_usaha','dana_acara','dana_lain','data_pinjam'));
    }
    public function detail ($id) {
        $tarik = Pengeluaran::find($id);

        return view('admin.pengeluaran.detail',compact('tarik'));
    }

    public function pengeluaran_detail ()
    {
        $pengeluaran_detail = Pengeluaran::all();

        return view('/admin/pengeluaran/detai_pengeluaranl', compact('pengeluaran_detail'));
    }
    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pengeluaran();
        $data_setor->anggota_id          = Auth::id();
        $data_setor->anggaran_id          = $request->input('anggaran_id');
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->pengurus_id            = Auth::id();
        $data_setor->save();
        $setor = Pengeluaran::find($data_setor->id);

//         $sid    = ""; 
//         $token  = ""; 
//         $twilio = new Client($sid, $token); 
//         // ketua
//         $message = $twilio->messages 
//                   ->create("whatsapp:+6281316563786", // to 
//                            array( 
//                                "from" => "whatsapp:+14155238886",       
//                                "body" => "Laporan !!!

// Aya anu atos bayar uang kas. Atos di konfirmasi ku bendahara sareng data tos masuk.

// Jumlah na : {$request->jumlah} 
// Keterangan : {$request->keterangan}

// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
//                            ) 
//                   ); 
//         // Sekertaris
//         $message = $twilio->messages 
//                   ->create("whatsapp:+6283825740395", // to 
//                            array( 
//                                "from" => "whatsapp:+14155238886",       
//                                "body" => "Laporan !!!

// Aya anu atos bayar uang kas. Atos di konfirmasi ku bendahara sareng data tos masuk. Supados pasti mangga cek deui datana

// Jumlah na : {$request->jumlah} 
// Keterangan : {$request->keterangan}

// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
//                            ) 
//                   ); 

        return redirect()->back()->with('sukses', 'Penarikan uang kas paratos di input mangga wae candak artosna');
        // return view('/tabungan/setor/cetak', compact('setor'));
    }
         //function untuk masuk ke view edit
         public function edit($id)
         {
            $data_tarik = Pengeluaran::orderByRaw('created_at DESC')->get();
            $data_anggota = User::orderByRaw('name ASC')->get();
            $data_anggaran = Anggaran::orderByRaw('nama_anggaran ASC')->get();
    
            $dana_darurat = Pengeluaran::where('anggaran_id',1)->get();
            $dana_amal = Pengeluaran::where('anggaran_id',2)->get();
            $dana_pinjam = Pengeluaran::where('anggaran_id',3)->get();
            $dana_usaha = Pengeluaran::where('anggaran_id',4)->get();
            $dana_acara = Pengeluaran::where('anggaran_id',5)->get();
            $dana_lain = Pengeluaran::where('anggaran_id',6)->get();

             $tarik = Pengeluaran::find($id);
             return view('/admin/pengeluaran/edit', compact('tarik','data_tarik','data_anggota','data_anggaran','dana_darurat','dana_amal','dana_pinjam','dana_usaha','dana_acara','dana_lain'));
         }
           
         public function update(Request $request, $id)
         {
            $request->validate([
               'jumlah' => 'numeric',
            ]);
           $setor = Pengeluaran::find($id);
           $setor->update($request->all());
           $setor->save();
            return redirect('/pengeluaran/tarik')->with('sukses', 'Data Setor Kas atos tiasa di edit');
         }
                 //function untuk hapus
         public function hapus($id)
         {
             $setor = Pengeluaran::find($id);
             $setor->delete();

             //         $sid    = ""; 
//         $token  = ""; 
//         $twilio = new Client($sid, $token); 
//         // ketua
//         $message = $twilio->messages 
//                   ->create("whatsapp:+6281316563786", // to 
//                            array( 
//                                "from" => "whatsapp:+14155238886",       
//                                "body" => "Laporan !!!

// Punten bade ngalaporkeun Admin nembe atos ngahapus data.

// Supados jelas mangga cek deui
// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
//                            ) 
//                   ); 
             return redirect('/pengeluaran/tarik')->with('sukses', 'Data Setor Tunai Atos Dihapus');
         }
     // End Admin

     // Pengajuan pinjaman
    public function pengajuan () {
        $data_pengajuan = Pengajuan::where('kategori',3)->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        return view('admin.pengeluaran.pengajuan',compact('data_pengajuan','data_anggota'));
    }
    public function pengajuan_lihat ($id) {
        $data_setor = Pengajuan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $setor = Pengajuan::find($id);

        return view('admin.pengeluaran.pengajuan_lihat', compact('setor','data_setor','data_anggota'));
    }

  
    public function pengajuan_tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Pengeluaran();
        $data_setor->anggota_id          = $request->input('anggota_id');
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->anggaran_id         = $request->input('kategori');
        $data_setor->status              = 'Nunggak';
        $data_setor->pengurus_id         = Auth::id();
        $data_setor->save();
        $setor = Pengeluaran::find($data_setor->id);
        // sekalian hapus data
        $pengajuan = Pengajuan::find($request->id_pengajuan);
        $pengajuan->delete();

//         $sid    = ""; 
//         $token  = ""; 
//         $twilio = new Client($sid, $token); 
//         // ketua
//         $message = $twilio->messages 
//                   ->create("whatsapp:+6281316563786", // to 
//                            array( 
//                                "from" => "whatsapp:+14155238886",       
//                                "body" => "Laporan !!!

// Aya anu atos bayar uang kas. Atos di konfirmasi ku bendahara sareng data tos masuk.

// Jumlah na : {$request->jumlah} 
// Keterangan : {$request->keterangan}

// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
//                            ) 
//                   ); 
//         // Sekertaris
//         $message = $twilio->messages 
//                   ->create("whatsapp:+6283825740395", // to 
//                            array( 
//                                "from" => "whatsapp:+14155238886",       
//                                "body" => "Laporan !!!

// Aya anu atos bayar uang kas. Atos di konfirmasi ku bendahara sareng data tos masuk. Supados pasti mangga cek deui datana

// Jumlah na : {$request->jumlah} 
// Keterangan : {$request->keterangan}

// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
//                            ) 
//                   ); 


        return redirect('/pengajuan/pinjam/anggota')->with('sukses', 'Data Pinjaman atos di Setujui');
    }
    // bayar pinjam
    // Pengajuan pinjaman
    public function bayar_pinjam()
    {
        $data_pengajuan = Pengajuan::where('kategori', 'bayar_pinjaman')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        return view('admin.pengeluaran.pengajuan', compact('data_pengajuan', 'data_anggota'));
    }
    public function bayar_pinjam_lihat($id)
    {
        $data_setor = Pengajuan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $setor = Pengajuan::find($id);

        return view('admin.pengeluaran.pengajuan_lihat', compact('setor', 'data_setor', 'data_anggota'));
    }


    public function bayar_pinjam_tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_bayar = new Bayar_Pinjam();
        $data_bayar->pembayaran          = $request->input('pembayaran');
        $data_bayar->pengeluaran_id             = $request->input('pengeluaran_id');
        $data_bayar->jumlah_bayar              = $request->input('jumlah');
        $data_bayar->save();
        $bayar = Bayar_Pinjam::find($data_bayar->id);
        // sekalian hapus data
        $pengajuan = Pengajuan::find($request->id_pengajuan);
        $pengajuan->delete();

        //         $sid    = ""; 
        //         $token  = ""; 
        //         $twilio = new Client($sid, $token); 
        //         // ketua
        //         $message = $twilio->messages 
        //                   ->create("whatsapp:+6281316563786", // to 
        //                            array( 
        //                                "from" => "whatsapp:+14155238886",       
        //                                "body" => "Laporan !!!

        // Aya anu atos bayar uang kas. Atos di konfirmasi ku bendahara sareng data tos masuk.

        // Jumlah na : {$request->jumlah} 
        // Keterangan : {$request->keterangan}

        // Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
        //                            ) 
        //                   ); 
        //         // Sekertaris
        //         $message = $twilio->messages 
        //                   ->create("whatsapp:+6283825740395", // to 
        //                            array( 
        //                                "from" => "whatsapp:+14155238886",       
        //                                "body" => "Laporan !!!

        // Aya anu atos bayar uang kas. Atos di konfirmasi ku bendahara sareng data tos masuk. Supados pasti mangga cek deui datana

        // Jumlah na : {$request->jumlah} 
        // Keterangan : {$request->keterangan}

        // Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/pemasukan/setor/",
        //                            ) 
        //                   ); 


        return redirect()->back()->with('sukses', 'Pembayaran dana pinjaman atos masuk');
    }

}
