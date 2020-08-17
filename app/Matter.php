<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $table = 'matters';

        protected $fillable = [
        'skill_count',
        'barning',
        'priogress',
        'time',
    ];
}
