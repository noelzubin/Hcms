<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\myfiles\myAuth;
use App\myfiles\General;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DiagnosticsController extends Controller
{
    //
    
    public function home() {
        session(["hospid"=>2]);
        if(MyAuth::check(MyAuth::$isDiagnostics))
            return view("diag.home");
        else
            return redirect("diag/login");
    }

    public function login() {
        if(MyAuth::check(MyAuth::$isDiagnostics))
            return redirect("diag");
        else
            return view("diag.login");
    }

    public function logindiag( Request $request) {
        $this->validate($request, ["id"=>"required","password"=>"required|min:8"]);
        $diag = DB::select("select * from `diagnostics` where `id` = " .$_POST["id"]);
        if($diag == null){
            session()->flash("error","Enter the correct credentials");
            return redirect("diag/login");
        }
        $diag = $diag[0];
        if(Hash::check($_POST["password"] , $diag->password )){
            MyAuth::login(MyAuth::$isDiagnostics,$_POST["id"]);
            return redirect("diag");
        }
        session()->flash("error","Enter the correct credentials");
        return redirect("diag/login");
    }

    public function logout() {
        MyAuth::logout();
        session()->flash("error","successfully logged out");
        return redirect("diag/login");
    }

    public function getDiags() {
        $diags = DB::connection("centraldb")->select('select * from `MR'. $_POST["uid"] .'` where `type`= "bldp" and `flag` = "0"');
        if($diags == null)
                return redirect("diag");
        $diags = $diags[0];
        $id  = $diags->id;
        $docId = $diags->docid;
        $patient = General::getPatient($_POST["uid"]);
        return view("diag.diagnose",compact("id","patient","docId"));
    }

    public function diagnosed(Request $request){
        $this->validate($request, ["mrId"=>"required","bldp"=>"required","docId"=>"required"]);
        DB::connection("centraldb")->table('MR'.$_POST["patId"])->where('id', $_POST["mrId"])->update(array('flag' => 1,"data"=>$_POST["bldp"]));
        General::addToQ($_POST["docId"],$_POST["patId"]);
        return redirect("diag");
    }
}
