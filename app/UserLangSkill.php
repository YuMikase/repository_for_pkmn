<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLangSkill extends Model
{
    protected $table = 'user_lang_skill';
    protected $guarded = ['id'];

    /**
     * 言語レベル更新
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
