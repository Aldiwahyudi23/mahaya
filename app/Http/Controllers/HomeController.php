<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\Kehadiran;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data_login = User::select('*')
        ->whereNotNull('last_seen')
        ->orderBy('last_seen', 'DESC')
        ->paginate(10);
        $pengumuman = Pengumuman::first();
        $guru = Kehadiran::count();
        $gurulk =Kehadiran::where('kehadiran', 'Hadir')->count();
        $gurupr =Kehadiran::where('kehadiran', 'Tidak')->count();
        $data_hadir =Kehadiran::all();

   
        return view('home',compact('data_login','pengumuman','guru','gurulk','gurupr','data_hadir'));
    }
    public function saveToken(Request $request)
    {
        Auth::user()->update(['device_token' => $request->token]);
        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        if ($request->input('kehadiran') == 'Tidak') {
        $request->validate(
            [
                'kehadiran'     => 'required',
                'siapa'  => 'required',
                'alasan'  => 'required',
                'tanggapan'  => 'required',
                
            ],
            [
                'kehadiran.required'        => "Kehadiran kedah di isi kanggo epaluasi kanggo ke acara.",
                'siapa.required'        => "teu kengeng kosong, Esian sesuai contoh. saha wae anu tiasa atawa anu teu tiasa ngiringan.",
                'alasan.required'        => "teu kengeng kosong, Esian sesuai alasan sesuai kondisi alasan teu tiasana. KHUSUS NU TEU TIASA",
                'tanggapan.required'        => "teu kengeng kosong, Esian tanggapan sesuai pertanyaan nu kolom koneng. KHUSUS NU TEU TIASA",

            ]
        );
    }else{
            $request->validate(
                [
                    'kehadiran'     => 'required',
                    'siapa'  => 'required',
                    'kedah'  => 'required',

                ],
                [
                    'kehadiran.required'        => "Kehadiran kedah di isi kanggo epaluasi kanggo ke acara.",
                    'siapa.required'        => "teu kengeng kosong, Esian sesuai contoh. saha wae anu tiasa atawa anu teu tiasa ngiringan.",
                    'kedah.required'        => "ALASAN SARENG TANGGAPAN KEDAH DI ISI.",

                ]
            );
    }
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

        if ($request->input('kehadiran') == 'Hadir') {

            return redirect()->back()->with('hadir', 'Hatur nuhun parantos kasadianana kanggo acara keluarga ieu, di mana acara ieu teh anu ku urang di pikahoyong. teu tiasa seer saur mung tiasa ngahatur nuhunkrun sa agengna gunung HARUMAN bakal jadi saksi bahwa keluarga urang teh rukun sauyunan Buktikeun keluarga urang bisa jeung mampu kana sagala kahadean, boh pribadi atanapi kanggo umum. Da URANG MAH TURUNAN PAJAJARAN SARENG SILIWANGI');
        } else {
            return redirect()->back()->with('tidak', 'Hatur nuhun parantos kersa nguninga kana pesan ieu, mugia urang di parinan kasehatan tur kasalametan dimanawae urang ayana. Hapunten nyuhunkeun di hapunten pami tina acara ieu teu acan tiasa optimal, di mana teu tiasa hadirna anjen di acara ieu mun tina acara iu bertepatan sareng kasibukan pribadi. tapi insya Allah kanggo kapayunna boh tina acara atanapi kasibukan pribadina, teu tiasa seer saur mung tiasa ngahatur nuhunkrun sa agengna gunung HARUMAN bakal jadi saksi bahwa keluarga urang teh rukun sauyunan Buktikeun keluarga urang bisa jeung mampu kana sagala kahadean, boh pribadi atanapi kanggo umum. Da URANG MAH TURUNAN PAJAJARAN SARENG SILIWANGI');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendNotification(Request $request)
    {
        //firebaseToken berisi seluruh user yang memiliki device_token. jadi notifnya akan dikirmkan ke semua user
        //jika kalian ingin mengirim notif ke user tertentu batasi query dibawah ini, bisa berdasarkan id atau kondisi tertentu

        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAHfhQEAw:APA91bFAHoruY9hcucTwGzdw3eYwuwKACPVgggtfTtEH1FHIz3YSTXj4tfiFrQhwjEH_7rqCoLMYeWQ4iFx4sUZ-sExhCz2X-4yvaudACBcEupa3VVtpzTesHg3uN2SleBKdTCnH4_nN';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "icon" => 'https://cdn.pixabay.com/photo/2016/05/24/16/48/mountains-1412683_960_720.png',
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }
}
