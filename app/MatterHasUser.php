<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatterHasUser extends Model
{
    protected $table = 'matter_has_user';
    protected $guarded = ['id'];
}
