<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    //关联表
    public $table = 'cate';
    //关联表主键
    public $primaryKey = 'cateId';
    //是否维护
    public $timestamps = false;
    //是否允许批量操作
    public $guarded = [];

}
