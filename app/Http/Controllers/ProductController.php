<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public static function getSearch(Request $request)
    {
        return Product::getSearch($request->get('q'));
    }
}
