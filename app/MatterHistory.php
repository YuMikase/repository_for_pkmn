<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterHistory extends Model
{
    protected $guarded = ['id'];
    protected $table = 'matters_history';
}
