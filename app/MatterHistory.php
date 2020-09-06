<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterHistory extends Model
{
    protected $guarded = ['id'];
    protected $table = 'matters_history';

    /**
     * 戦闘履歴に所属するユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
