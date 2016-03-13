<?php

namespace App\Http\Controllers;

use App\patient;
use App\Pharmacy;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\myfiles\myAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PharmacyController extends Controller
{

    public function home(){
        session(["hospid"=>2]);
        if(MyAuth::check(MyAuth::$isPharmacy)){
            return view("pharmacy.home");
        }
        else
            return redirect("phar/login");
    }

    
    public function login(){
        if(MyAuth::check(myAuth::$isPharmacy))
            return redirect("phar");
        else
            return view("pharmacy.login");
    }

    public function loginPhar(Request $request){
        $this->validate($request,["id"=>"required","password"=>"required|min:8"]);
        $phar = Pharmacy::find($_POST["id"]);
        if($phar == null){
            session()->flash("error","Enter correct credentials");
            return redirect("phar/login");
        }
        if(Hash::check($_POST["password"], $phar->password )){
            MYAuth::login(MyAuth::$isPharmacy,$_POST["id"]);
            return redirect("phar");
        }
        session()->flash("error","Enter correct credentials");
        return redirect("phar/login");
    }


    public function logout(){
        myAuth::logout();
        session()->flash("error","Successfully logged out");
        return redirect("phar/login");
    }


    public function signup() {
        if(MyAuth::check(myAuth::$isPharmacy))
            return redirect("phar");
        else
            return view("pharmacy.signup");
    }


    public function signupPhar(Request $request){
        $this->validate($request, ["id"=>"required","password"=>"required|min:8"]);
        $input = $_POST;
        $phar = new Pharmacy;
        $phar->id = $input["id"];
        $phar->password = bcrypt($input["password"]);
        $phar->save();
        session()->flash("error","Successfully signed up, You can log in now");
        return redirect("phar/");
    }

    public function getPres(){
        $id = $_POST["uid"];
        $pat = patient::find($id);
        if($pat == null)
            redirect("phar");
        $patRecs = DB::connection("centraldb")->select('select * from `MR'. $id .'` where `type` = "pres" and `flag` = "0" ');
        session(["patId"=>$pat->uid]);
        return view("pharmacy.buy",compact("patRecs","pat"));
    }

    public function updatePres(){
        $presList = ($_POST["presList"]);
        if($presList == null ){
            return redirect("phar");
        }
        $presList = explode(",","$presList");
        $uid = session("patId");
        foreach ($presList as $pres) {
            DB::connection("centraldb")->statement('UPDATE `MR'. $uid .'` SET `flag`=1 WHERE `id`=' . $pres);
        }
        return redirect("phar");
    }

}
