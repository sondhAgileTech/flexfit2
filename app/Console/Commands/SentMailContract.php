<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Contract;
use App\MailContract;
use App\ContractProduct;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SentMailContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mailcontract';

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
        $now = Carbon::now();
        $email = [];
        $data = DB::table('mail')
            ->join('contract', 'contract.contract_code', '=', 'mail.contract_code')
            ->where('mail.status', 1)
            ->select('mail.id','mail.email','contract.contract_code', 'contract.name_customer', 'contract.finish_date')
            ->get();
        foreach ($data as $value) {
            if($value->email != null) {
                if($value->status == 2) {
                    break;
                }
                Mail::send('mail_contract', ['data' => $value], function($message) use ($value) {
                    $message->to($value->email)->subject
                       ('Thông tin bảo hành từ Flexfit');
                    $message->from(env('MAIL_USERNAME','nguyenthutrang.vtalb@gmail.com'),'Bảo hành Flextfit');
                });
                if( count(Mail::failures()) > 0 ) {

                    \Log::info("wrong");
                 
                 } else {
                    DB::table('mail')
                    ->where('id', $value->id)
                    ->update(['status' => 2]);
                 }
                // $email[] = $value->email;
            }

        }

        // Mail::send('mail_contract', ['data' => ''], function($message) use ($email) {
        //     $message->to('dinhhongson23596@gmail.com')->bcc($email)->subject
        //        ('Thông tin bảo hành từ Flexfit');
        //     $message->from(env('MAIL_USERNAME','nguyenthutrang.vtalb@gmail.com'),'Bảo hành Flextfit');
        // });



        \Log::info($now);
        \Log::info("Cron is working fine!");
    }
}
