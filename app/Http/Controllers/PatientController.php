<?php

namespace App\Http\Controllers;

use App\patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\myfiles\myAuth;
use App\myfiles\General;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * home page of patient , accessible only when logged in
     */
    public function home(){
        session(["hospid"=>2]);
        if(MyAuth::check(MyAuth::$isPatient)){
            $id = session("loggedUserId");
            $patient = General::getPatient($id);
            $ilns = General::getMedRecIllns($id);
            $proc = General::getMedRecProc($id);
            $pres = General::getMedRecPres($id);
            $patient = General::getPatient(session("loggedUserId"));
            return view("patient.home",compact("patient","ilns","proc","pres","patient"));
        }
        else
            return redirect("patient/login");
    }

    /**
     * login page of patient,
     */
    public function login(){
        if(MyAuth::check(MyAuth::$isPatient))
            return redirect("patient");
        else
            return view("patient.login");
    }

    /**
     * singup page of patient
     */
    public function signup(){
        if(MyAuth::check(MyAuth::$isPatient))
            return redirect("patient");
        else
            return view("patient.signup");
    }

    /**
     * logout page of patient
     */
    public function logout(){
        myAuth::logout();
        return redirect("patient/login");
    }

    /**
     * function to check if user already has a password
     * else redirect to singup
     */
    public function checkLogin(){
        $name = $_POST["name"];
        $password = $_POST["password"];
        $pat = null;
        if($this->isAPatient($name)){
            $pat = $this->getPatient($name);
            if($pat->password != "" && $pat->password != null) {
                if(Hash::check($password , $pat->password)) {
                    //login
                    myAuth::login(MyAuth::$isPatient, $pat->uid);
                    return redirect("patient");
                }else{
                    return redirect("patient/login");
                }
            }
        }
        return redirect("patient/signup");
    }

    /**
     * sign the patient up, add password and MR table
     * for the patient.
     */
    public function signHimUp() {
        $name = $_POST["name"];
        $password = $_POST["password"];
        if($this->isAPatient($name)) {
            $pat = $this->getPatient($name);
            if($pat->password != "" && $pat->password != null) {
                return redirect("patient/login");
            }else{
                DB::connection('centraldb')->update("update `patients` set `password` = ? where `uid` = ?",[Hash::make($password) , $pat->uid ]);
                return redirect("patient/login");
            }
        }
        session(["password"=>$password]);
        return redirect("patient/adharReg");
    }

    public function adharReg(){
        return view("patient.adharReg");
    }

    public function addPatient() {
        $input = $_POST;
        $input["age"] = date("Y") - $input["yob"];
        general::addPat($input);
        $pat = patient::where("uid", $input["uid"])->first();
        $pat->password = bcrypt(session("password"));
        $pat->save();
        return redirect("patient/login");
    }

    public function getBloodPress() {
        $uid = session("loggedUserId");
        $bldps = General::getMedRecBldp($uid);
        return $bldps;
    }


    //Helper functions
    
    public function isAPatient($name) {
        $pat = DB::connection('centraldb')->select('select * from patients where `name` = ?',[$name]);
        return (sizeof($pat) > 0);
    }

    public function getPatient($name) {
        $pat = DB::connection('centraldb')->select('select * from patients where `name` = ?',[$name]);
        return $pat[0];
    }



}
