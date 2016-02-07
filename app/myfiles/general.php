<?php

namespace App\myfiles;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\patient;
use Mockery\CountValidator\Exception;
use App\lpatients;


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

    public static function addPat($patient){
        $pat = patient::where("uid", $patient["uid"])->first();
        if($pat == null) {
            $pat = new patient;
            $pat->name = $patient["name"];
            $pat->uid = $patient["uid"];
            $pat->gender = $patient["gender"];
            $pat->yob = $patient["yob"];
            $pat->gname = $patient["gname"];
            $pat->house = $patient["house"];
            $pat->street = $patient["street"];
            $pat->lm = $patient["lm"];
            $pat->dist = $patient["dist"];
            $pat->state = $patient["state"];
            $pat->pc = $patient["pc"];
            $pat->age = $patient["age"];
            $pat->hospital = session("hospid");
            $pat->save();
            $sql = "create table `MR". $patient["uid"] ."` (
                `id` int unsigned not null auto_increment primary key,
                `docid` int not null, `hospid` int not null,
                `type` varchar(255) not null,
                `data` varchar(255) not null,
                `created_at` timestamp not null,
                `updated_at` timestamp not null)
                default character set utf8 collate utf8_unicode_ci";
            DB::connection("centraldb")->statement($sql);
        }
        $pat = lpatients::find($patient["uid"]);
        if( $pat == null ){
            $pat = new lpatients;
            $pat->id = $patient["uid"];
            $pat->name = $patient["name"];
            $pat->save();
        }
    }
}

?>

