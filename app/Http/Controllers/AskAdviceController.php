<?php

namespace App\Http\Controllers;

use App\AskAdvice;
use App\Contract;
use App\Library\TokenGenerator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;

class AskAdviceController extends Controller
{
    public static function get(Request $request) {

       $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required'
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $contract_code = $request->input('contract_code');

        $data = [];


        $infoContract = Contract::where('contract_code', $contract_code)->first();
        if($infoContract) {
            
            Mail::send('mail_received_gifts', ['infoContract' => $infoContract, 'receiver' => $name ], function($message) use ($data, $email) {
                $message->to($email)->subject
                   ('Phiếu quà tặng từ Flexfit');
                $message->from(env('MAIL_USERNAME','nguyenthutrang.vtalb@gmail.com'),'Bảo hành Flextfit');
            });
        }
        
        // $data = AskAdvice::create([
        //     'name' => $name,
        //     'phone' => $phone,
        //     'email' => $email,
        //     'contract_code' => $contract_code
        // ]);

        // $data->save();
        return response()->json(['success' => ['status' => 200]]);
    }

    public static function getReceivedGift(Request $request) {
        return view('form_info_receiver');
    }

    public static function getInfoReciever(Request $request) {
        return response()->json(['success' => ['status' => 200]]);
    } 
}