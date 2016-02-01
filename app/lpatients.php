<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lpatients extends patient
{
    protected $connection = 'mysql';
    protected $table = 'lpatients';
    protected $fillable = ["name","uid","docPref"];
}