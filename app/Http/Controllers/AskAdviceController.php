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

        $dataArr = [];

        $data = AskAdvice::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'contract_code' => $contract_code
        ]);

        $data->save();

        $infoContract = Contract::where('contract_code', $contract_code)->first();
        if($infoContract) {
            
            Mail::send('mail_received_gifts', ['infoContract' => $infoContract, 'receiver' => $name, 'advice_id' => $data->id ], function($message) use ($dataArr, $email) {
                $message->to($email)->subject
                   ('Phiếu quà tặng từ Flexfit');
                $message->from(env('MAIL_USERNAME','nguyenthutrang.vtalb@gmail.com'),'Bảo hành Flextfit');
            });
        }
        
//         $data = AskAdvice::create([
//             'name' => $name,
//             'phone' => $phone,
//             'email' => $email,
//             'contract_code' => $contract_code
//         ]);
//
//         $data->save();
        return response()->json(['success' => ['status' => 200]]);
    }

    public static function getReceivedGift(Request $request, $id) {
        $advice = AskAdvice::find($id);
        return view('form_info_receiver', ['id' => $id, 'contract_code' => $advice->contract_code]);
    }

    public static function getInfoReciever(Request $request) {
        $validatedData = $request->validate([
            'typeOfProject' => 'required',
            'advice_id' => 'required',
            'contractCode' => 'required',
            'phone' => 'required',
            'floorArea' => 'required',
            'constructionAddress' => 'required'

        ]);

        $typeOfProject = $request->input('typeOfProject');
        $advice_id = $request->input('advice_id');
        $phone = $request->input('phone');
        $floorArea = $request->input('floorArea');
        $constructionAddress = $request->input('constructionAddress');
        $contractCode = $request->input('contractCode');

        $data = AskAdvice::find($advice_id);
        if(!is_null($data) && ($data->contract_code == $contractCode)) {
            $data->type_of_project = $typeOfProject;
            $data->floor_area = $floorArea;
            $data->construction_address = $constructionAddress;
            $data->phone_received = $phone;

            if($data->save()) {
                return response()->json(['success' => ['status' => 200]]);
            } else {
                return response()->json(['success' => ['status' => 404]]);
            }
        } else {
            return response()->json(['success' => ['status' => 400]]);
        }
    } 
}