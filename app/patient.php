<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    //
    protected $connection = 'centraldb';
    protected $table = 'patients';
    protected $fillable = ["uid","name","password","age","gender","gname","house","street","district","yob","lm","pc"];

}
