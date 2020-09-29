<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = 'notification';
    protected $fillable = [
        'contract_code',
        'product_id',
        'changed_date_maintain',
        'status'
    ];
}
