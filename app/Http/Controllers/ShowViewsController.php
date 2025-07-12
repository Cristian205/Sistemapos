<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowViewsController extends Controller
{
    //
    public function ShowViewDashboard(){
        $user = Auth::user();
        return view('Dashboard.Views-Dashboard', compact('user'));
    }

    public function ShowViewLogin(){
        return view('Login.Views-login');
    }
}
