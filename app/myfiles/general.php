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
 */
class General{

    /**
     * @param $spec
     * @return mixed
     */
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

    /**
     * @param $docs
     * @return mixed
     */
    public static function getqueue($docs){
        foreach($docs as $doc){
            $doc->queue = explode("," , $doc->queue);
        }
        return $docs;
    }

    /**
     * @param $doc
     * @param $pat
     */
    public static function addToQ($doc, $pat){
        $docQ = DB::select('select `queue` from ldoctors where id = "' . $doc .'"' )[0]->queue;
        $docQ = $docQ .",".$pat;
        $docQ = DB::update('update ldoctors set queue = ? where id = ?', [$docQ,$doc]);
        return;
    }

    /**
     * @return array
     */
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

    /**
     * @param $patient
     */
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
                `docid` int not null,
                `hospid` int not null,
                `type` varchar(255) not null,
                `data` varchar(255) not null,
                `flag` int unsigned not null,
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


    /**
     * @return array of patients of logged in doctor
     */
    public static function getDocQ(){
        $docQ = DB::select('select `queue` from ldoctors where id = "' . session("loggedUserId") .'"' )[0]->queue;
        $docQ = array_filter(explode(",",$docQ));
        $arr = array();
        foreach($docQ as $patid){
            $name = DB::select('select `name` from lpatients where id = "' . $patid .'"' )[0]->name;
            $ar = array(
              "id" => $patid,
              "name" => $name
            );
            array_push($arr, $ar);
        }
        return $arr;
    }

    /**
     * @return String name of the logged in doctor
     */
    public static function getDocName(){
        $name = DB::select('select `name` from ldoctors where id = "' . session("loggedUserId") .'"' )[0]->name;
        return $name;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public static function getPatient($uid){
        $pat = patient::find($uid);
        return $pat;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public static function getMedRec($uid){
        $medr = DB::connection("centraldb")->select('select * from MR'.$uid);
        return $medr;
    }


    /**
     * @param patientId
     * @return 20 illness records
     */
    public static function getMedRecIllns($uid){
        $medr = DB::connection("centraldb")->select('select * from MR'.$uid .' where `type` = "ilns" order by `id` desc LIMIT 10' );
        return $medr;
    }

    /**
     * @param patientId
     * @return 20 procedure records
     */
    public static function getMedRecProc($uid){
        $medr = DB::connection("centraldb")->select('select * from MR'.$uid .' where `type` = "proc" order by `id` desc LIMIT 10' );
        return $medr;
    }

    /**
     * @param patientId
     * @return 20 prescription records
     */
    public static function getMedRecPres($uid){
        $medr = DB::connection("centraldb")->select('select * from MR'.$uid .' where `type` = "pres" order by `id` desc LIMIT 10' );
        return $medr;
    }

    /**
     * @param $id
     */
    public static function popQ($id){
        $docQ = DB::select('select `queue` from ldoctors where id = "' . session("loggedUserId") .'"' )[0]->queue;
        $docQ = array_filter(explode(",",$docQ));
        $pos = array_search($id, $docQ);
        unset($docQ[$pos]);
        DB::update('update ldoctors set queue = ? where id = ?', [ implode(",",$docQ) ,session("loggedUserId")]);
        return;
    }
}

?>

