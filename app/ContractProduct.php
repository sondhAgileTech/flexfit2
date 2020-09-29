<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractProduct extends Model
{
    //
    protected $table = 'contract_product';
    protected $fillable = ['product_id', 'contract_id', 'selected_at'];
}
