<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSoals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_soals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('teks')->nullable();
            //$table->bigInteger('category')->nullable();
            //$table->bigInteger('sub_category')->nullable();
            $table->bigInteger('score')->nullable()->default(1);
            //$table->longText('pembahasan')->nullable();
            //$table->bigInteger('created_by')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('created_by_id')->nullable()->default(0);
            $table->bigInteger('updated_by_id')->nullable()->default(0);
            $table->bigInteger('deleted_by_id')->nullable()->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_soals');
    }
}
