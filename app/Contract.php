<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    protected $table = 'contract';

    public function product_list()
    {
        return $this->hasMany(ContractProduct::class, 'contract_id');
    }

    public function getExtraAttribute($extra)
    {
        Return array_values(json_decode($extra, true) ?: []);
    }

    public function setExtraAttribute($extra)
    {
        $this->attributes['extra'] = json_encode(array_values($extra));
    }

    public function getProductsAttribute($value)
    {
        return explode(',', $value);
    }

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = implode(',', $value);
    }
}