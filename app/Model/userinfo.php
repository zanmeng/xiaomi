<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    //关联表
    public $table = 'user_info';
    //关联表主键
    public $primaryKey = 'userid';
    //是否维护
    public $timestamps = false;
    //是否允许批量操作
    public $guarded = [];

//    public function user()
//    {
//        return $this->belongsTo('App\Model\User','uid','users_info');
//    }

}
