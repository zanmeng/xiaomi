<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    public $table='cats';
    public $primaryKey='catid';
    public  $timestamps=false;
    public  $guarded=[];
}
