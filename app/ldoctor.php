<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ldoctor extends doctor
{
    //
    protected $connection = 'mysql';
    protected $table = 'ldoctors';
    protected $fillable = ["queue"];
}
