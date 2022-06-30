<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
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

   
        return view('home',compact('data_login','pengumuman'));
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
