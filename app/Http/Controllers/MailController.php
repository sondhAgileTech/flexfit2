<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Contract;
use App\ContractProduct;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function getHtmlBasic() {

      $data = Contract::select('*')
            ->whereBetween(DB::raw('DATE_ADD(contract.finish_date, INTERVAL 3 MONTH)'), [Carbon::now(), Carbon::now()->addDays(7)])
            ->orWhereBetween(DB::raw('DATE_ADD(contract.finish_date, INTERVAL 6 MONTH)'), [Carbon::now(), Carbon::now()->addDays(7)])
            ->orWhereBetween(DB::raw('DATE_ADD(contract.finish_date, INTERVAL 12 MONTH)'), [Carbon::now(), Carbon::now()->addDays(7)])
            ->first();

      if(is_array($data->products)) {
         $listProduct = [];
         foreach ($data->products as $item) {
               $product = Product::where('id',(int)$item)->first();
               $listProduct[] = $product;
         }
      }

      $now = Carbon::now();

      return view('mail', ['data'=> $data, 'now' => $now, 'products' => $listProduct]);
   }

}