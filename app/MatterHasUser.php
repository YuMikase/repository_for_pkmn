<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterHasUser extends Model
{
    protected $table = 'matter_has_user';
    protected $guarded = ['id'];

     /**
     * 案件に関連するユーザーレコードを取得
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
