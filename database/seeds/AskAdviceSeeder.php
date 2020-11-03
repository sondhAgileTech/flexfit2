<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AskAdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ask_advice')->delete();

        for ($i = 1; $i < 10; $i++)
        {
          DB::table('ask_advice')->insert([
              'id' => $i,
              'name' =>  Str::random(10),
              'phone' => '123456789',
          ]);
        }
    }
}