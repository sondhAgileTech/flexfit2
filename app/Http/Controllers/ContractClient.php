<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Product;
use App\QuestionAnswer;
use App\ContractText;
use App\ContractProduct;
use Illuminate\Support\Facades\DB;
use App\Library\TokenGenerator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

class ContractClient extends Controller
{
    public static function get(Request $request) {
        $data = Contract::where(['contract_code' => $request->id])->first();
        if($data) {
            $now = date('Y-m-d H:i:s');
            // if(is_array($data->products)) {
            //     $listProduct = [];
            //     foreach ($data->products as $item) {
            //         $product = Product::where('id',(int)$item)->first();
            //         if($product) {
            //             $listProduct[] = $product;
            //         }
            //     }
            // }
            $contractProduct = ContractProduct::where(['contract_id' => $data->id])->get();
                $listProduct = [];
                foreach ($contractProduct as $item) {
                    // $product = Product::where('id',(int)$item->product_id)->first();
                    $product = DB::table('product')
                                ->join('contract_product', 'contract_product.product_id', '=', 'product.id')
                                ->where('product.id', $item->product_id)
                                ->first();
                    if($product) {
                        $listProduct[] = $product;
                    }
                }
                // dd($listProduct);
            if($data->language === 'vi') {
                return view('contract_none_token', [
                    'data' => $data,
                    'products' => $listProduct,
                    'now' => $now ,
                    'content_text' => ContractText::GetLetterThankYou(),
                    'question_answer' => QuestionAnswer::where('language','=', 'vi')->get(),
                    'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
            } else {
                return view('contract_none_tokent_en', [
                    'data' => $data,
                    'products' => $listProduct,
                    'now' => $now ,
                    'content_text' => ContractText::GetLetterThankYouEnglish(),
                    'question_answer' => QuestionAnswer::where('language','=', 'en')->get(),
                    'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
            }
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
                ])->first();
                if($data) {
                    $now = date('Y-m-d H:i:s');
                    if(is_array($data->products)) {
                        $listProduct = [];
                        foreach ($data->products as $item) {
                            $product = Product::where('id',(int)$item)->first();
                            if($product) {
                                $listProduct[] = $product;
                            }
                        }
                    }

                    if($data->language === 'vi') {
                        return view('contract_none_token', [
                            'data' => $data,
                            'products' => $listProduct,
                            'now' => $now ,
                            'content_text' => ContractText::GetLetterThankYou(),
                            'question_answer' => QuestionAnswer::where('language','=', 'vi')->get(),
                            'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
                    } else {
                        return view('contract_none_tokent_en', [
                            'data' => $data,
                            'products' => $listProduct,
                            'now' => $now ,
                            'content_text' => ContractText::GetLetterThankYouEnglish(),
                            'question_answer' => QuestionAnswer::where('language','=', 'en')->get(),
                            'token' => base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256))]);
                    }
                } else {
                    return abort(404);
                }
            }
            else return abort(404);
        }
        else return abort(404);
    }

    public static function changedTimeMainTainContract(Request $request) {
        $contract_id = $request->input('contract_id');
        $dateMaintain = $request->input('date_maintain');
        $contract_code = $request->input('contract_code');

        $newDate = Carbon::createFromFormat('d/m/Y', $dateMaintain)->format('Y-m-d H:i:s');

        if($contract_id) {
            $data = Contract::where('contract.id', '=', $contract_id)
                                    ->update(['contract.changed_time_maintain' => $newDate, 'contract.status_changed_time_maintain' => 'pending']);
            if($data) {
                return response()->json(['success' => ['status' => 200]]);
            }    
        }
    }

    public static function getPdfFile($id_contract) {
        $data = Contract::where('contract.contract_code', '=', $id_contract)->first();
        if($data){
            $token = base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256));
            $customPaper = array(0,0,300,520);

            // return view('pdf_contract',compact('token'));
            // pass view file
            $pdf = PDF::loadView('pdf_contract', compact('token'))->setPaper($customPaper, 'landscape')->setOptions(['isRemoteEnabled' => true,'logOutputFile'=>storage_path('logs/pdf.log'),'tempDir'=>storage_path('logs/')]);

            //download pdf
            return $pdf->stream();
        }
    }

    public static function getFileContract(Request $request) {
        $contract_code = $request->input('contract_code');
        $data = Contract::where('contract.contract_code', '=', $contract_code)->first();
        if($data){
            if($data->file_upload) {
                if($data) {
                    $fileName = Storage::getMetaData($data->file_upload);
                    return response()->json(['success' => ['status' => 200, 'file_name'=>$fileName]]);
                } 
            }
        }
    }
}
