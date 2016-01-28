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
 *
 */
class myAuth{


    public static function check($sessid){
        if (Session::has('loggedin')){
            if(session('loggedin') == $sessid)
                return true;
        }
        return false;
    }


    public static function login($sessid,$id){
        session(["loggedin" => $sessid , "loggedUserId" => $id ]);
    }

    public static function logout(){
        session()->flush();
    }
}

?>