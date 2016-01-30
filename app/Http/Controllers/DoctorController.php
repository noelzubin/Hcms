<?php

namespace App\Http\Controllers;

use App\doctor;
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
        $doc = DB::connection('centraldb')->select('select * from Doctors where name = ? and hospital = ?', [$input["name"] , session("hospid") ]);
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


    /**
     * signup page of doctor
     */
    public function signup(){
        if(MyAuth::check(1))
            return redirect("doctor/");
        else
            $hosp = DB::connection('centraldb')->select('select * from `Hospitals`');
            return view("doctor.signup",compact("hosp"));
    }


    public function signupdoc(Request $request){
        $this->validate($request, ["name"=>"required|min:2","password"=>"required|min:5","hospital"=>"required"]);
        $input = $_POST;
        $doc = new doctor;
        $doc->name = $input["name"];
        $doc->password = Hash::make($input["password"]);
        $doc->hospital = $input["hospital"];
        $doc->save();
        $doc = DB::connection('centraldb')->select('select * from Doctors where name = ?', [$doc->name])[0];
        DB::connection('mysql')->insert('insert into ldoctors (id, name) values (?, ?)', [$doc->id, $doc->name]);
        return redirect("doctor/");
    }

}
