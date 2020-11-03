<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contract')->delete();

        for ($i = 1; $i < 10; $i++)
        {
          DB::table('contract')->insert([
              'id' => $i,
              'contract_code' =>  Str::random(10),
              'name_customer' => Str::random(10),
              'construction_items' => Str::random(10),
              'phone' => 123456789,
              'address' => Str::random(10),
              'email' =>  Str::random(10).'@gmail.com',
              'status_mainten' => true,
              'finish_date' => '2020-09-11 02:05:07',
              'language' => 'vi',
              'products' => '1,2,3',
          ]);
        }
    }
}