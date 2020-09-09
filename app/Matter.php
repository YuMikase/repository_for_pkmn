<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $table = 'matters';

    protected $guarded = [
        'id',
    ];

    public function users()
    {
        return $this->hasMany('App\MatterHasUser', 'matter_id', 'id');
    }
}
