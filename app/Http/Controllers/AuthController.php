<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function todoLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = $request->all();
        unset($user['_token']);

        if(Auth::guard('user')->attempt($user)){
            return redirect()->route('barang.index');
        }else{
            return redirect()->back()->with('status', 'password atau username salah!!');
        }
    }

    public function logout()
    {
        $user = Auth::guard('user');
        $user->logout();

        return redirect()->route('barang.index');
    }
}
