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
        'phone' => 'required|numeric',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $data = AskAdvice::create([
            'name' => $name,
            'phone' => $phone,
        ]);

        $data->save();
        return response()->json(['success' => ['status' => 200]]);
    }
}