<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    protected $table = 'contract';

    public function getProductsAttribute($value)
    {
        return explode(',', $value);
    }

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = implode(',', $value);
    }
}