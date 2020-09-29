<?php

namespace App\Http\Controllers;

use App\AskAdvice;
use App\Library\TokenGenerator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AskAdviceController extends Controller
{
    public static function get(Request $request) {

       $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $contract_code = $request->input('contract_code');
        $data = AskAdvice::create([
            'name' => $name,
            'phone' => $phone,
            'contract_code' => $contract_code
        ]);

        $data->save();
        return response()->json(['success' => ['status' => 200]]);
    }
}