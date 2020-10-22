<?php

namespace App\Imports\Member;

use App\AppModelsContract;
use App\Contract;
use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ImportMember implements ToModel,WithStartRow,WithHeadingRow
{

    public function headingRow() : int
    {
        return 1;
    }

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model
    */
    public function model(array $row)
    {
        $product = Product::firstOrCreate([
            'name' => trim($row['hang_muc_thi_cong']),
            'provider' => 'Flexfit',
            'status_maitain_product' => true
        ]);

        $contract_code = trim($row['ma_hop_dong']);                 
        $name_customer = trim($row['ho_va_ten_khach_hang']); 
        $construction_items = trim($row['hang_muc_thi_cong']);
        $phone = trim($row['so_dien_thoai']);
        $address = trim($row['dia_chi']);
        $email = trim($row['email']);
        $status_mainten = ($row['trang_thai']==='Bảo hành')?1:0;
        $language = ($row['ngon_ngu_su_dung']==='en')?'en':'vi';
        $finish_date = $this->transformDate($row['ngay_hoan_thanh'])->format('Y-m-d H:i:s');

        $data = Product::where('name', $construction_items)->first();

        $contract = Contract::firstOrCreate([
            'contract_code' => $contract_code,
            'name_customer' => $name_customer,
            'construction_items' => $construction_items,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
            'status_mainten' => $status_mainten,
            'language' => $language,
            'finish_date' => $finish_date,
            'products' => [$data->id]
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
           * From the first few lines to process the data is not to process the title
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
