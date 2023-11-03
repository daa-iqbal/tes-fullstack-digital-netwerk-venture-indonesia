<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('alamat')->nullable();
            $table->uuid('provinsi_id')->nullable();
            $table->uuid('kota_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('personal_kontak')->nullable();
            $table->string('id_file_photo_1')->nullable();
            $table->string('id_file_photo_2')->nullable();
            $table->string('id_file_photo_3')->nullable();
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
        Schema::dropIfExists('umkms');
    }
}
