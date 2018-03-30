<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    public $table='category';
    public $primaryKey='gid';
    public  $timestamps=false;
    public  $guarded=[];
}
