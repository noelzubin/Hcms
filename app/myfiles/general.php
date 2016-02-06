<?php

namespace App\myfiles;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


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
class General{

    public static function getdocs($spec){
        $doctors = DB::select('select `id`,`queue`,`name` from ldoctors where speciality = "' . $spec .'"' );
        $doctors = self::getqueue($doctors);
        $loggedInDoctors = self::getloggedinDocs();
        foreach($doctors as $doctor){
            $doctor->loggedin = 0;
            if( in_array($doctor->id, $loggedInDoctors))
                $doctor->loggedin = 1;
        }
        return json_encode($doctors);
    }

    public static function getqueue($docs){
        foreach($docs as $doc){
            $doc->queue = explode("," , $doc->queue);
        }
        return $docs;
    }

    public static function addToQ($doc,$pat){
        $docQ = DB::select('select `queue` from ldoctors where id = "' . $doc .'"' )[0]->queue;
        $docQ = $docQ .",".$pat;
        $docQ = DB::update('update ldoctors set queue = ? where id = ?', [$docQ,$doc]);
        return;
    }

    public static function getloggedinDocs(){
        $docs = array();
        $sesns = DB::select('select `payload` from sessions');
        foreach($sesns as $sesn){
            $data = unserialize(base64_decode($sesn->payload));
            if(isset($data["loggedin"]) &&  ($data["loggedin"] == 1) ){
                array_push($docs, $data["loggedUserId"] );
            }
        }
        return $docs;
    }
}

?>

