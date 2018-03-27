<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class homeUser extends Model
{
    //
    //关联表
    public $table = 'user_login';
    //关联表主键
    public $primaryKey = 'login_id';
    //是否维护
    public $timestamps = false;
    //是否允许批量操作
    public $guarded = [];

    //关联模型
    public function userinfo()
    {
        return $this->hasOne('App\Model\userinfo','uid','login_id');

    }

}
