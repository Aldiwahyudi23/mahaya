<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $user = $user->groupBy('role');
        return view('admin.user.index', compact('user'));
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
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'role' => 'required',
    //     ]);

    //     if ($request->role == 'Guru') {
    //         $countGuru = Guru::where('id_card', $request->nomer)->count();
    //         $guruId = Guru::where('id_card', $request->nomer)->get();
    //         foreach ($guruId as $val) {
    //             $guru = Guru::findorfail($val->id);
    //         }
    //         if ($countGuru >= 1) {
    //             User::create([
    //                 'name' => $guru->nama_guru,
    //                 'email' => $request->email,
    //                 'password' => Hash::make($request->password),
    //                 'role' => $request->role,
    //                 'id_card' => $request->nomer,
    //             ]);
    //             return redirect()->back()->with('success', 'Berhasil menambahkan user Guru baru!');
    //         } else {
    //             return redirect()->back()->with('error', 'Maaf User ini tidak terdaftar sebagai guru!');
    //         }
    //     } elseif ($request->role == 'Siswa') {
    //         $countSiswa = Siswa::where('no_induk', $request->nomer)->count();
    //         $siswaId = Siswa::where('no_induk', $request->nomer)->get();
    //         foreach ($siswaId as $val) {
    //             $siswa = Siswa::findorfail($val->id);
    //         }
    //         if ($countSiswa >= 1) {
    //             User::create([
    //                 'name' => strtolower($siswa->nama_siswa),
    //                 'email' => $request->email,
    //                 'password' => Hash::make($request->password),
    //                 'role' => $request->role,
    //                 'no_induk' => $request->nomer,
    //             ]);
    //             return redirect()->back()->with('success', 'Berhasil menambahkan user Siswa baru!');
    //         } else {
    //             return redirect()->back()->with('error', 'Maaf User ini tidak terdaftar sebagai siswa!');
    //         }
    //     } else {
    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'role' => $request->role,
    //         ]);
    //         return redirect()->back()->with('success', 'Berhasil menambahkan user Admin baru!');
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        if ($id == "Admin" && Auth::user()->role == "Operator") {
            return redirect()->back()->with('warning', 'Maaf halaman ini hanya bisa di akses oleh Admin!');
        } else {
            $user = User::where('role', $id)->get();
            $role = $user->groupBy('role');
            return view('admin.user.show', compact('user', 'role'));
        }
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
        $user = User::findorfail($id);
        if ($user->role == 'Admin') {
            if ($user->id == Auth::user()->id) {
                $user->delete();
                return redirect()->back()->with('warning', 'Data user berhasil dihapus! (Silahkan cek trash data user)');
            } else {
                return redirect()->back()->with('error', 'Maaf user ini bukan milik anda!');
            }
        } elseif ($user->role == 'Operator') {
            if ($user->id == Auth::user()->id || Auth::user()->role == 'Admin') {
                $user->delete();
                return redirect()->back()->with('warning', 'Data user berhasil dihapus! (Silahkan cek trash data user)');
            } else {
                return redirect()->back()->with('error', 'Maaf user ini bukan milik anda!');
            }
        } else {
            $user->delete();
            return redirect()->back()->with('warning', 'Data user berhasil dihapus! (Silahkan cek trash data user)');
        }
    }

    public function trash()
    {
        $user = User::onlyTrashed()->paginate(10);
        return view('admin.user.trash', compact('user'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::withTrashed()->findorfail($id);
        $user->restore();
        return redirect()->back()->with('info', 'Data user berhasil direstore! (Silahkan cek data user)');
    }

    public function kill($id)
    {
        $user = User::withTrashed()->findorfail($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'Data user berhasil dihapus secara permanent');
    }

    public function email(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $countUser = User::where('email', $request->email)->count();
        if ($countUser >= 1) {
            return redirect()->route('reset.password', Crypt::encrypt($user->id))->with('success', 'Email ini sudah terdaftar!');
        } else {
            return redirect()->back()->with('error', 'Maaf email ini belum terdaftar!');
        }
    }

    public function password($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findorfail($id);
        return view('auth.passwords.reset', compact('user'));
    }

    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::findorfail($id);
        $user_data = [
            'password' => Hash::make($request->password)
        ];
        $user->update($user_data);
        return redirect()->route('login')->with('success', 'User berhasil diperbarui!');
    }

    public function profile()
    {
        return view('user.pengaturan');
    }

    public function edit_profile()
    {
        $user = User::all();
        $profile = Profile::all();
        return view('user.profile', compact( 'user'));
    }

    public function ubah_profile(Request $request)
    {
            $user = auth()->user();
            
            $user->name = $request->name;
            if ($request->has('password') && $request->password != "") {
                if (Hash::check($request->old_password, $user->password)) {
                    if ($request->password == $request->password_confirmation) {
                        $user->password = bcrypt($request->password);
                    } else {
                        return response()->json('Konfirmasi password tidak sesuai', 422);
                    }
                } else {
                    return response()->json('Password lama tidak sesuai', 422);
                }
            }
    
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/img'), $nama);
    
                $user->foto = "/img/$nama";
            }

        $user->update();

        return redirect()->back()->with('success', 'Foto Profile anda berhasil diperbarui!!');
    }

    public function edit_foto()
    {
        if (Auth::user()->role == 'Guru' || Auth::user()->role == 'Siswa') {
            return view('user.foto');
        } else {
            return redirect()->back()->with('error', 'Not Found 404!');
        }
    }

    public function ubah_foto(Request $request)
    {
            $this->validate($request, [
                'foto' => 'required'
            ]);
            $profile = Profile::where('id', Auth::user()->id)->first();
            $foto = $request->foto;
            $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
            $profile_data = [
                'foto' => 'uploads/user/' . $new_foto,
            ];
            $foto->move('uploads/user/', $new_foto);
            $profile->update($profile_data);
            return redirect()->route('profile')->with('success', 'Foto Profile anda berhasil diperbarui!!');
    
    }

    public function edit_email()
    {
        return view('user.email');
    }

    public function ubah_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email'
        ]);
        $user = User::findorfail(Auth::user()->id);
        $cekUser = User::where('email', $request->email)->count();
        if ($cekUser >= 1) {
            return redirect()->back()->with('error', 'Maaf email ini sudah terdaftar!');
        } else {
            $user_email = [
                'email' => $request->email,
            ];
            $user->update($user_email);
            return redirect()->back()->with('success', 'Email anda berhasil diperbarui!');
        }
    }

    public function edit_password()
    {
        return view('user.password');
    }

    public function ubah_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::findorfail(Auth::user()->id);
        if ($request->password_lama) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_lama == $request->password) {
                    return redirect()->back()->with('error', 'Maaf password yang anda masukkan sama!');
                } else {
                    $user_password = [
                        'password' => Hash::make($request->password),
                    ];
                    $user->update($user_password);
                    return redirect()->back()->with('success', 'Password anda berhasil diperbarui!');
                }
            } else {
                return redirect()->back()->with('error', 'Tolong masukkan password lama anda dengan benar!');
            }
        } else {
            return redirect()->back()->with('error', 'Tolong masukkan password lama anda terlebih dahulu!');
        }
    }

    public function cek_email(Request $request)
    {
        $countUser = User::where('email', $request->email)->count();
        if ($countUser >= 1) {
            return response()->json(['success' => 'Email Anda Benar']);
        } else {
            return response()->json(['error' => 'Maaf user not found!']);
        }
    }

    public function cek_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $countUser = User::where('email', $request->email)->count();
        if ($countUser >= 1) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json(['success' => 'Password Anda Benar']);
            } else {
                return response()->json(['error' => 'Maaf user not found!']);
            }
        } else {
            return response()->json(['warning' => 'Maaf user not found!']);
        }
    }
}
