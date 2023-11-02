<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('current_apk_version_name')->nullable()->default(NULL);
            $table->string('current_apk_version_code')->nullable()->default(NULL);
            $table->unsignedBigInteger('file_id')->nullable();
            $table->string('token_login_mobile', 1000)->nullable()->default(NULL);
            $table->dateTime('token_login_mobile_kadaluarsa')->nullable()->default(NULL);
            $table->bigInteger('master_paket_id')->nullable()->default(0);
            $table->string('phone')->unique();
            $table->dateTime('phone_verified_at')->nullable();
            $table->string('token_firebase', 255)->nullable()->default(NULL);
            $table->boolean('is_active')->default(0);
            $table->boolean('built_in')->default(0);
            $table->dateTime('last_signedin')->nullable();
            $table->dateTime('last_access')->nullable();
            $table->dateTime('last_update_location')->nullable();
            $table->double('latitude')->default(0.0);
            $table->double('longitude')->default(0.0);
            $table->string('device_info')->nullable()->default(NULL);

            //$table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
            $table->bigInteger('created_by_id')->nullable()->default(0);
            $table->bigInteger('updated_by_id')->nullable()->default(0);
            $table->bigInteger('deleted_by_id')->nullable()->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
