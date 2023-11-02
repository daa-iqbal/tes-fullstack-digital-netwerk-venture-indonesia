<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifiedAtInTokenVerifactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('token_verifications', function (Blueprint $table) {
           $table->dateTime('verified_at')->nullable()->after('token_verification');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('token_verifications', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });
    }
}
