<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskAdvice extends Model
{
    //
    protected $table = 'ask_advice';

    protected $fillable = [
        'name',
        'phone',
    ];
}