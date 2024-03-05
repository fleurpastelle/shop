<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Membuat instance baru dari ProfileController.
     *
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan profil pengguna saat ini.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show_profile()
    {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }

    /**
     * Mengedit profil pengguna saat ini.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return Redirect::back();
    }
}
