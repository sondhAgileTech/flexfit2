<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Library\TokenGenerator;
use Illuminate\Http\Request;

class ContractClient extends Controller
{
    //
    public static function get(Request $request) {
        $data = Contract::where(['contract_code' => $request->id])->first();
        return view('contract_none_token', ['data' => $data, 'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
    }

    public static function getToken(Request $request) {
        $token = $request->token;
        $tokenDecode = base64_decode($request->token);
        $tokenDecode = TokenGenerator::decrypt($tokenDecode, env('APP_KEY'), 256);
        if($tokenDecode)
        {
            $dataList = explode('<>',$tokenDecode);
            if(isset($dataList[0])&&isset($dataList[1])&&isset($dataList[2])) {
                $data = Contract::where([
                    'id' => $dataList[0],
                    'contract_code' => $dataList[1],
                    'email' => $dataList[2]
                ])->first();
                if($data) return view('contract_with_token', ['data' => $data]);
                else return abort(404);
            }
            else return abort(404);
        }
        else return abort(404);
    }
}
