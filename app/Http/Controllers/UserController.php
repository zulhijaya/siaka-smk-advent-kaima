<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function redirect()
    {
        if( auth()->user()->role == 'Guru' || auth()->user()->role == 'Bendahara' ) {
            return redirect()->route('admin.guru.detail', auth()->user()->guru->id);
        } elseif( auth()->user()->role == 'Siswa' ) {
            return redirect()->route('admin.siswa.detail', auth()->user()->siswa->id);
        } else {
            return redirect()->route('admin.siswa.siswa-aktif');
        }
    }

    public function editPassword()
    {
        return view('admin.user.ganti-password', [
            'title' => 'Ganti Password'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login');
    }
}
