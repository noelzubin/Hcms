<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\myfiles\myAuth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{

    /**
     * home page of doctor , accessible only when logged in
     */
    public function home(){
        if(MyAuth::check(1))
            return view("doctor.home");
        else
            return redirect()->action('DoctorController@login');
    }


    /**
     * login page of doctor,
     */
    public function login(){
        if(MyAuth::check(1))
            return redirect("doctor");
        else
            return view("doctor.login");
    }


    /**
     * logout page of doctor
     */
    public function logout(){
        myAuth::logout();
        return redirect("doctor/login");
    }


    /**
     * login form POST request handler
     */
    public function logindoc(Requests\doctorLogin $request){
        $input = $_POST;
        $doc = DB::connection('centraldb')->select('select * from Doctors where name = ?', [$input["name"]]);
        if($doc == null)
            return view("doctor.login");
        else{
            $doc = $doc[0];
            if(Hash::check(trim($input["password"]), $doc->password)) {
                myAuth::login(1, $doc->id);
                return redirect("doctor/");
            }
            else
                return "wrong credentials";
        }
    }


}
