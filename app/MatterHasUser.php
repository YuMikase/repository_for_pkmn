<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterHasUser extends Model
{
    protected $table = 'matter_has_user';
    protected $guarded = ['id'];

     /**
     * ユーザーに関連する電話レコードを取得
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
