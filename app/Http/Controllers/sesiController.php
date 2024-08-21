<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sesiController extends Controller
{
    function index() {
        return view('login');
    }

    function login(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required' => 'email wajib di isi',
            'password.required' => 'password wajib di isi',
        ]
        );
        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];
        if(Auth::attempt($infologin)) {
            return redirect('home');
        } else{
            return redirect('')->withErrors('user dan pw salah')->withInput();
        }
    }
}
