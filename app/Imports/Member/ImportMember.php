<?php

namespace App\Imports\Member;

use App\AppModelsContract;
use App\Contract;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportMember implements ToModel,WithStartRow,WithHeadingRow
{

    public function headingRow() : int
    {
        return 1;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model
    */
    public function model(array $row)
    {

        $contract_code = $row['ma_hop_dong'];                 
        $name_customer = $row['ho_va_ten_khach_hang']; 
        $construction_items = $row['hang_muc_thi_cong'];
        $phone = $row['so_dien_thoai'];
        $address = $row['dia_chi'];
        $email = $row['email'];
        $status_mainten  = $row['trang_thai'];
        $language = $row['ngon_ngu_su_dung'];
        $finish_date = $row['ngay_hoan_thanh'];

        $newDate = Carbon::createFromFormat('d-m-Y', $row['ngay_hoan_thanh'])->format('Y-m-d H:i:s');
        return new Contract([
            'contract_code' =>$contract_code,
            'name_customer' => $name_customer,
            'construction_items' => $construction_items,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
            'status_mainten' => ($status_mainten==='Bảo trì')?1:0,
            'language' => ($language==='en')?'en':'vi',
            'finish_date' => $newDate
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
