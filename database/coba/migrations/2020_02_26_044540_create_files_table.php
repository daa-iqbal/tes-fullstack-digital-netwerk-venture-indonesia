<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ext', 255)->nullable()->default('');
            $table->unsignedBigInteger('ftype_id');
            $table->unsignedBigInteger('user_id');
            $table->string('caption')->nullable();
            $table->string('path');
            $table->string('path_thumbnail');
            $table->string('folder', 255)->nullable()->default('');
            $table->string('full_path');
            $table->string('full_path_thumbnail');
            $table->double('size_in_bytes');
            $table->bigInteger('created_by_id')->nullable()->default(0);
            $table->bigInteger('updated_by_id')->nullable()->default(0);
            $table->bigInteger('deleted_by_id')->nullable()->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();



            $table->foreign('ftype_id')->references('id')->on('ftypes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
