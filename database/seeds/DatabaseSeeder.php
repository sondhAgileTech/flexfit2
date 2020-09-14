<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AskAdviceSeeder::class);
        $this->call(ContractSeeder::class);
        $this->call(MenuAdminSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(QuestionAnswerSeeder::class);
    }
}
