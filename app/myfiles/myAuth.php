<?php

namespace App\myfiles;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class myAuth
 * @package App\myfiles
 *
 * for phpsessions(sessid):
 *   loggedin:
 *      1. Doctor
 *      2. Receptionists
 *      3. Patients
 *      4. Pharmacies
 */
class myAuth{

    //sessid for php sessions
    // logged in:
    public static $isDoctor = 1;
    public static $isReceptionist = 2;
    public static $isPatient = 3;
    public static $isPharmacy = 4;
    public static $isDiagnostics = 5;
    

    public static function check($sessid){
        if (Session::has('loggedin')){
            if(session('loggedin') == $sessid)
                return true;
        }
        return false;
    }


    public static function login($sessid,$id){
        session(["loggedin" => $sessid , "loggedUserId" => $id]);
    }

    public static function logout(){
        $temphospid = session("hospid");
        session()->flush();
        session([ "hospid" => $temphospid ]);
    }


}

?>