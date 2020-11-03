<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->delete();

        for ($i = 1; $i < 10; $i++)
        {
          DB::table('product')->insert([
              'id' => $i,
              'name' =>  Str::random(10),
              'provider' => Str::random(10),
              'status_maitain_product' => '1'
          ]);
        }
    }
}