<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    protected $table = 'contract';
    protected $primaryKey = 'id';

    protected $fillable = [
        'contract_code', 'name_customer',
        'construction_items', 'phone',
        'address', 'email','status_mainten','finish_date',
        'language',
        'products'
    ];


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