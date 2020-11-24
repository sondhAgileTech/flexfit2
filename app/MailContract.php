<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailContract extends Model
{
    //
    protected $table = 'mail';

    protected $fillable = [
        'email','status','contract_code'
    ];

}