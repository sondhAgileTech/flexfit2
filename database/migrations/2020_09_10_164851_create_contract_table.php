<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_code');
            $table->string('name_customer');
            $table->string('construction_items');
            $table->string('phone');
            $table->string('address');
            $table->string('email');
            $table->boolean('status_mainten');
            $table->datetime('finish_date');
            $table->datetime('changed_time_maintain')->nullable();
            $table->string('status_changed_time_maintain')->nullable();
            $table->string('language');
            $table->text('file_upload')->nullable();
            $table->text('products')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
}
