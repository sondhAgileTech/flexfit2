<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContractProduct;
use App\Notification;
use Carbon\Carbon;
class ContractProductController extends Controller
{
    //
    public static function changedTimeMainTain(Request $request) {
        $product_id = $request->input('product_id');
        $contract_id = $request->input('contract_id');
        $dateMaintain = $request->input('date_maintain');
        $contract_code = $request->input('contract_code');

        $newDate = Carbon::createFromFormat('d/m/Y', $dateMaintain)->format('Y-m-d H:i:s');

        if($product_id && $contract_id) {
            $data = ContractProduct::where('contract_product.product_id', '=',  $product_id)
                                    ->where('contract_product.contract_id', '=', $contract_id)
                                    ->update(['contract_product.changed_time_maintain' => $newDate]);
            if($data) {
                $noti = Notification::create([
                    'contract_code' => $contract_id,
                    'product_id' => $product_id,
                    'changed_date_maintain' => $newDate,
                    'status' => 'pending'
                ]);
                $noti->save();
                return response()->json(['success' => ['status' => 200]]);
            }    
        }
    }

}
