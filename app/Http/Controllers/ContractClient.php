<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Product;
use App\QuestionAnswer;
use App\Library\TokenGenerator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContractClient extends Controller
{
    //
    public static function get(Request $request) {
        $data = Contract::where(['contract_code' => $request->id])->first();
        $now = date('Y-m-d H:i:s');

        if(is_array($data->products)) {
            $listProduct = [];
            foreach ($data->products as $item) {
                $product = Product::where('id',(int)$item)->first();
                $listProduct[] = $product;
            }
        }

        $countdown_1 = Carbon::now()->diffInDays(Carbon::parse($data->finish_date)->addMonth(3), false);
        $countdown_2 = Carbon::now()->diffInDays(Carbon::parse($data->finish_date)->addMonth(6), false);
        $countdown_3 = Carbon::now()->diffInDays(Carbon::parse($data->finish_date)->addMonth(12), false);

        if($data->language === 'vi') {
            return view('contract_none_token', [
                'countdown_1' => $countdown_1,
                'countdown_2' => $countdown_2,
                'countdown_3' => $countdown_3,
                'data' => $data,
                'products' => $listProduct,
                'now' => $now ,
                'question_answer' => QuestionAnswer::get(),
                'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
        } else {
            return view('contract_none_tokent_en', [
                'countdown_1' => $countdown_1,
                'countdown_2' => $countdown_2,
                'countdown_3' => $countdown_3,
                'data' => $data,
                'products' => $listProduct,
                'now' => $now ,
                'question_answer' => QuestionAnswer::get(),
                'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
        }
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
                if($data) {
                    $now = date('Y-m-d H:i:s');

                    if(is_array($data->products)) {
                        $listProduct = [];
                        foreach ($data->products as $item) {
                            $product = Product::where('id',(int)$item)->first();
                            $listProduct[] = $product;
                        }
                    }
            
                    $countdown_1 = Carbon::now()->diffInDays(Carbon::parse($data->finish_date)->addMonth(3), false);
                    $countdown_2 = Carbon::now()->diffInDays(Carbon::parse($data->finish_date)->addMonth(6), false);
                    $countdown_3 = Carbon::now()->diffInDays(Carbon::parse($data->finish_date)->addMonth(12), false);
            
                    if($data->language === 'vi') {
                        return view('contract_none_token', [
                            'countdown_1' => $countdown_1,
                            'countdown_2' => $countdown_2,
                            'countdown_3' => $countdown_3,
                            'data' => $data,
                            'products' => $listProduct,
                            'now' => $now ,
                            'question_answer' => QuestionAnswer::get(),
                            'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
                    } else {
                        return view('contract_none_tokent_en', [
                            'countdown_1' => $countdown_1,
                            'countdown_2' => $countdown_2,
                            'countdown_3' => $countdown_3,
                            'data' => $data,
                            'products' => $listProduct,
                            'now' => $now ,
                            'question_answer' => QuestionAnswer::get(),
                            'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
                    }
                    // return view('contract_with_token', ['data' => $data]);
                } else {
                    return abort(404);
                }
            }
            else return abort(404);
        }
        else return abort(404);
    }
}
