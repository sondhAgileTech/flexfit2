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
}
