<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try{
            Schema::create('confirmation_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->string('code')->unique();
                $table->timestamp('expired_at');
                $table->unsignedBigInteger('confirmation_type_id');
                $table->bigInteger('created_by_id')->nullable()->default(0);
                $table->bigInteger('updated_by_id')->nullable()->default(0);
                $table->bigInteger('deleted_by_id')->nullable()->default(0);
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->dateTime('deleted_at')->nullable();

                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('confirmation_type_id')->references('id')->on('confirmation_types')->onUpdate('cascade')->onDelete('cascade');
            });
        }catch(PDOException $ex){
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confirmation_users');
    }
}
