<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\myfiles\myAuth;
use App\myfiles\General;
class DiagnosticsController extends Controller
{
    //
    
    public function home() {
        session(["hospid"=>2]);
        if(MyAuth::check(MyAuth::$isDiagnostics))
            return view("diag.home");
        else
            return redirect(diag/login);
    }

    public function login() {
        if(MyAuth::check(MyAuth::$isDiagnostics))
            return redirect("diag");
        else
            return view("diag.login");
    }

    public function logindiag() {

    }

    public function logout() {
        MyAuth::logout();
        return redirect("diag/login");
    }
}
