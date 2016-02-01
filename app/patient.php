<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    //
    protected $connection = 'centraldb';
    protected $table = 'patients';
    protected $fillable = ["uid","password","hospital","name","gender","gname","house","street","dist","yob","lm","pc"];

}
