<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    public $table='goods';
    public $primaryKey='gid';
    public $timestamps=false;
    public $guarded=[];

}
