<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

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
}
