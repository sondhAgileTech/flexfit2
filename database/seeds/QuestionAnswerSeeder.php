<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_answer')->delete();
    
        for ($i = 1; $i < 10; $i++)
        {
          DB::table('question_answer')->insert([
              'id' => $i,
              'question' =>  Str::random(10),
              'answer' => Str::random(10),
          ]);
        }
    }
}
// php artisan make:seeder QuestionAnswerSeeder
// php artisan make:seeder AskAdviceSeeder
// php artisan make:seeder ProductSeeder
// php artisan make:seeder MenuAdminSeeder
// php artisan make:seeder ContractSeeder