<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    //
    protected $connection = 'centraldb';
    protected $table = 'Doctors';
    protected $fillable = ["name","password","hospitals"];

}
