<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $logins = Login::all();
        return view('login.index', compact('logins'));
    }
}
