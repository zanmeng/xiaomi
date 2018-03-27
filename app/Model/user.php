<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
//    1. 模型关联的数据表
    public $table = 'user';

//    2. 主键
    public $primaryKey = 'userId';

//    3. 是否维护created_at updated_at
    public $timestamps = false;

//    4. 是否允许批量操作字段
    public $guarded = [];
}