<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'product';

    public static function getSearch($q)
    {
        return self::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    //get list product follow contract id
    public static function getProducts($id) {
        return self::select('*')
                    ->join('contract_product', 'product.id', '=', 'contract_product.product_id')
                    ->where('contract_product.contract_id', '=', $id)
                    ->get();
    }
}
