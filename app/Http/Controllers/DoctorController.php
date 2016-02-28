<?php

namespace App\Http\Controllers;

use App\doctor;
use App\ldoctor;
use App\myfiles\General;
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
        session(["hospid"=>2]);
        if(MyAuth::check(MyAuth::$isDoctor)){
            $patQ = General::getDocQ();
            $docName = General::getDocName();
            return view("doctor.home",compact("patQ","docName"));
        }
        else
            return redirect("doctor/login");
//            return redirect()->action('DoctorController@login');

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
        $this->validate($request, ["name"=>"required|min:2","password"=>"required|min:5","hospital"=>"required","speciality"=>"required"]);
        $input = $_POST;
        $doc = new doctor;
        $doc->name = $input["name"];
        $doc->password = Hash::make($input["password"]);
        $doc->hospital = $input["hospital"];
        $doc->save();
        if(session("hospid") == $doc->hospital)
        {
            $ldoc = new ldoctor();
            $ldoc->id = $doc->id;
            $ldoc->name = $doc->name;
            $ldoc->speciality = $input["speciality"];
            $ldoc->save();
        }
        return redirect("doctor/");
    }

    public function patTreat(Request $request){
        $this->validate($request, ["patId"=>"required"]);
        $id = $_POST["patId"];
        $patient = General::getPatient($id);
        $MRec = General::getMedRec($id);
        return view('doctor.patTreat',compact("patient","MRec"));
    }

    public function patResult(){
        $prescription = $_POST["pres"];
        if(strlen($prescription) > 0){
            $prescription = explode(",",$prescription);
            foreach($prescription as $pres)
            DB::connection('centraldb')->insert('insert into MR'.$_POST["uid"].' (docid,hospid,type,data) values (?, ?, ?, ?)', [ session("loggedUserId"),session("hospid"),"pres", $pres]);
        }

        $procedure = $_POST["proc"];
        if(strlen($procedure) > 0){
            $procedure = explode(",",$procedure);
            foreach($procedure as $proc)
                DB::connection('centraldb')->insert('insert into MR'.$_POST["uid"].' (docid,hospid,type,data) values (?, ?, ?, ?)', [ session("loggedUserId"),session("hospid"),"proc", $proc]);
        }
        if(strlen($_POST["ilns"]) > 0){
            DB::connection('centraldb')->insert('insert into MR'.$_POST["uid"].' (docid,hospid,type,data) values (?, ?, ?, ?)', [ session("loggedUserId"),session("hospid"),"ilns", $_POST["ilns"] ]);
        }
        General::popQ($_POST["uid"]);
        return redirect("doctor/");
    }

}
