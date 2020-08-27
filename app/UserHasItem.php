<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasItem extends Model
{
    protected $table = 'user_has_item';
    protected $guarded = ['id'];
}
