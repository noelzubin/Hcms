<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\myfiles\myAuth;
use App\myfiles\General;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ReceptionController extends Controller
{

    public function home(){
        session(["hospid"=>2]);
        if(MyAuth::check(2))
            return view("reception.home");
        else
            return redirect()->action('ReceptionController@login');
    }

    public function login(){
        if(MyAuth::check(2))
            return view("reception.home");
        else
            return view("reception.login");
    }

    public function logindesk(Request $request){
        $this->validate($request, ["id"=>"required|integer","password"=>"required|min:5"]);
        $input = $_POST;
        $desk = DB::select('select * from receptions where id = ? and hospital = ?', [$input["id"], session("hospid")]);
        if($desk == null)
            return view("reception.login");
        else{
            $desk = $desk[0];
            if(Hash::check(trim($input["password"]), $desk->password)) {
                myAuth::login(2, $desk->id);
                return redirect("desk/");
            }
            else
                return "wrong credentials";
        }
    }

    public function logout(){
        myAuth::logout();
        return redirect("desk/login");
    }

    public function patVisit(){
        $input = $_POST;
        $input["age"] = date("Y") -  $input["yob"];
        General::addPat($input);
        return view("reception.patVisit", compact("input"));
    }

    public function getDocs(){
        return General::getdocs($_POST["spec"]);
    }

    public function addPatToQ(Request $request){
        if(isset($_POST["doctor"])){
            General::addToQ($_POST["doctor"],$_POST["patId"]);
        }
        return redirect("desk/");
    }


}
