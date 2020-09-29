<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Contract;
use App\ContractProduct;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SentMailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $data = Contract::select('*')
        ->whereBetween(DB::raw('DATE_ADD(contract.finish_date, INTERVAL 3 MONTH)'), [Carbon::now(), Carbon::now()->addDays(7)])
        ->orWhereBetween(DB::raw('DATE_ADD(contract.finish_date, INTERVAL 6 MONTH)'), [Carbon::now(), Carbon::now()->addDays(7)])
        ->orWhereBetween(DB::raw('DATE_ADD(contract.finish_date, INTERVAL 12 MONTH)'), [Carbon::now(), Carbon::now()->addDays(7)])
        ->first();

        \Log::info(env('MAIL_USERNAME','nguyenthutrang.vtalb@gmail.com'));
        \Log::info($data);
        if($data) {
            if(is_array($data->products)) {
                $listProduct = [];
                foreach ($data->products as $item) {
                    $product = Product::where('id',(int)$item)->first();
                    $listProduct[] = $product;
                }
            }
    
            $now = Carbon::now();
            Mail::send('mail', ['data' => $data , 'products'=> $listProduct, 'now' => $now], function($message) use ($data) {
                $message->to('dinhhongson23596@gmail.com')->subject
                   ('Danh sách sản phẩm sắp đến hạn bảo hành');
                $message->from(env('MAIL_USERNAME','nguyenthutrang.vtalb@gmail.com'),'Bảo hành Flextfit');
             });
        }

        \Log::info("Cron is working fine!");
    }
}
