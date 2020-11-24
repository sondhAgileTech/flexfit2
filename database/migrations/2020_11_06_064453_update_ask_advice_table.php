<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAskAdviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ask_advice', function (Blueprint $table) {
            $table->integer('type_of_project')->nullable();
            $table->integer('floor_area')->nullable();
            $table->string('construction_address')->nullable();
            $table->string('phone_received')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ask_advice', function (Blueprint $table) {
            $table->dropColumn('type_of_project');
            $table->dropColumn('floor_area');
            $table->dropColumn('construction_address');
            $table->dropColumn('phone_received');
        });
    }
}
