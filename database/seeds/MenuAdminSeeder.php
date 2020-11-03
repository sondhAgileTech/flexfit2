<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->delete();

        DB::table('admin_menu')->insert([
            'id'=> 8,
            'parent_id' => 0,
            'order' => 7,
            'title' => 'Hợp đồng',
            'icon' => 'fa-bars',
            'uri' => 'contracts',
            'permission' => '*'
        ]);

        DB::table('admin_menu')->insert([
            'id'=> 9,
            'parent_id' => 0,
            'order' => 8,
            'title' => 'Sản phẩm',
            'icon' => 'fa-list-alt',
            'uri' => 'products',
            'permission' => '*'
        ]);

        DB::table('admin_menu')->insert([
            'id'=> 10,
            'parent_id' => 0,
            'order' => 9,
            'title' => 'Danh sách bảo hành',
            'icon' => 'fa-briefcase',
            'uri' => 'list-contract-maintain',
            'permission' => '*'
        ]);

        DB::table('admin_menu')->insert([
            'id'=> 11,
            'parent_id' => 0,
            'order' => 10,
            'title' => 'Câu hỏi và trả lời',
            'icon' => 'fa-question',
            'uri' => 'question-answer',
            'permission' => '*'
        ]);

        DB::table('admin_menu')->insert([
            'id'=> 12,
            'parent_id' => 0,
            'order' => 11,
            'title' => 'Yêu cầu tư vấn',
            'icon' => 'fa-phone-square',
            'uri' => 'ask-advice',
            'permission' => '*'
        ]);
    }
}