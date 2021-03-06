<?php

namespace App\Http\Controllers;

use App\Models\Bayar_Pinjam;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pemasukan;
use App\Models\Pengajuan;
use App\Models\Pembayaran;
use App\Models\Pemberitahuan;
use App\Models\Pengeluaran;
use App\Models\program;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Psy\Command\WhereamiCommand;
use Twilio\Rest\Client; 

class PemasukanController extends Controller
{
    public function index () {
        $data_setor = Pemasukan::where('anggota_id', Auth::user()->id)->orderBy('anggota_id')->get();
        $data_semua = Pemasukan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();

        $bulans = Pemasukan::select([
            DB::raw('date_format(tanggal, "%Y") as month'),
            DB::raw('count(tanggal) as count'),
        ])->groupBy('month')
        ->get();

        return view('admin.pemasukan.index',compact('data_setor','data_anggota','data_semua','bulans'));
    }

    public function pemasukan_detail()
    {
        $pemasukan_detail = Pemasukan::all();

        return view ('admin.pemasukan.detail_pemasukan',compact('pemasukan_detail'));
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
        $data_setor->pembayaran             = $request->input('pembayaran');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->pengurus_id            = Auth::id();
        $data_setor->save();
        $setor = Pemasukan::find($data_setor->id);

           // Metode pembayaran
           $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_pembayaran = new Pembayaran();
        $data_pembayaran->kategori          = $request->input('pembayaran');
        $data_pembayaran->jumlah              = $request->input('jumlah');
        $data_pembayaran->keterangan          = $request->input('keterangan');
        $data_pembayaran->save();
        $pembayaran = Pembayaran::find($data_pembayaran->id);

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
        return redirect('/pemasukan/setor')->with('sukses', 'Data Setor Tunai Atos Dihapus');
    }
// End Admin

// Pembayaran
    public function pembayaran (Request $request) {
                   // Metode pembayaran
                   $request->validate([
                    'jumlah' => 'numeric',
                ]);
                $data_pembayaran = new Pembayaran();
                $data_pembayaran->kategori          = 'Transfer';
                $data_pembayaran->jumlah              = $request->input('jumlah');
                $data_pembayaran->keterangan          = $request->input('keterangan');
                $data_pembayaran->save();
                $pembayaran = Pembayaran::find($data_pembayaran->id);
        
//                 $sid    = ""; 
//                 $token  = ""; 
//                 $twilio = new Client($sid, $token); 
//                 // ketua
//                 $message = $twilio->messages 
//                           ->create("whatsapp:+6281316563786", // to 
//                                    array( 
//                                        "from" => "whatsapp:+14155238886",       
//                                        "body" => "Laporan Setor Tunai!!!

// Bendahara atos ngalebetkeun artos kas kana buku tabungan.

// Jumlah na : {$request->jumlah} 
// Keterangan : {$request->keterangan}

// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/",
//                                    ) 
//                           ); 
//                 // Sekertaris
//                 $message = $twilio->messages 
//                           ->create("whatsapp:+6283825740395", // to 
//                                    array( 
//                                        "from" => "whatsapp:+14155238886",       
//                                        "body" => "Laporan Setor Tunai!!!

// Bendahara atos ngalebetkeun artos kas kana buku tabungan. Supados pasti mangga cek deui datana

// Jumlah na : {$request->jumlah} 
// Keterangan : {$request->keterangan}

// Kanggo ningal laporanna klik wae link  ieu http://kaskeluarga.royaldi21.com/",
//                                    ) 
//                           ); 
        
                return redirect()->back()->with('sukses', 'Setor Tunai uang Kas parantos Ka tambahkeun kana data');
                // return view('/tabungan/setor/cetak', compact('setor'));
    }

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
        $data_setor->pembayaran          = $request->input('pembayaran');
        $data_setor->save();
        $setor = Pemasukan::find($data_setor->id);

        // Metode pembayaran
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_pembayaran = new Pembayaran();
        $data_pembayaran->kategori          = $request->input('pembayaran');
        $data_pembayaran->tanggal             = $request->input('tanggal');
        $data_pembayaran->jumlah              = $request->input('jumlah');
        $data_pembayaran->keterangan          = $request->input('keterangan');
        $data_pembayaran->save();
        $pembayaran = Pembayaran::find($data_pembayaran->id);

        // // Pemberitahuan
        // $request->validate([
        //     'jumlah' => 'numeric',
        // ]);
        // $data_pemberitahuan = new Pemberitahuan();
        // $data_pemberitahuan->anggota_id          = $request->input('anggota_id');
        // $data_pemberitahuan->keterangan          = $request->input('keterangan');
        // $data_pemberitahuan->pengurus_id              = Auth::id();
        // $data_pemberitahuan->kategori              = 'Ketua' ;
        // $data_pemberitahuan->save();
        // $pemberitahuan = pemberitahuan::find($data_pemberitahuan->id);


        // sekalian hapus data
        $pengajuan = Pengajuan::find($request->id_pengajuan);
        $pengajuan->delete();

// Whatsapp twio
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

        return redirect('/pengajuan/setor/anggota')->with('sukses', 'Data Pembayaran Kas Parantos Ka tambahkeun kana data');
    }

    // Laporan pembayaran
    public function pembayaran_lihat($id)
    {
        $data_setor = Pemasukan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $data = Pemasukan::find($id);

        $status = Pemasukan::find($id);
        $status_ = [
            'status' => 2
        ];
        $status->update($status_);

        return view('admin.pemasukan.laporan_pemasukan', compact('data', 'data_setor', 'data_anggota'));
    }


    // bayar pinjam
    public function bayar_pinjam()
    {
        $data_pengajuan = Pengajuan::where('kategori', 'bayar_pinjaman')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        return view('admin.pemasukan.bayar_pinjaman', compact('data_pengajuan', 'data_anggota'));
    }
    public function bayar_pinjam_lihat($id)
    {
        $data_setor = Pengajuan::orderByRaw('created_at DESC')->get();
        $data_anggota = User::orderByRaw('name ASC')->get();
        $setor = Pengajuan::find($id);

        return view('admin.pemasukan.bayar_pinjaman_lihat', compact('setor', 'data_setor', 'data_anggota'));
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
        $data_bayar->keterangan              = $request->input('keterangan');
        $data_bayar->save();
        $bayar = Bayar_Pinjam::find($data_bayar->id);

        // Sekalian Edit pengeluaran
        $data_pinjaman = Pengeluaran::find($request->pengeluaran_id);
        $setor = Pengeluaran::findorfail($request->pengeluaran_id);
        if ($request->proses + $request->jumlah == $data_pinjaman->jumlah)
        {
                $setor_data = [
                    'status' => 'Lunas'
                ];
                $setor->update($setor_data);
            }else {
         
        }
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


        return redirect('/pengajuan/bayar/anggota')->with('sukses', 'Pembayaran dana pinjaman atos masuk');
    }

}
