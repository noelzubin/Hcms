<?php

namespace App\myfiles;

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
        $doctors = DB::select('select `id`,`queue` from ldoctors where speciality = "GP"');
        return json_encode($doctors);
        return $doctors;
    }
}

?>

