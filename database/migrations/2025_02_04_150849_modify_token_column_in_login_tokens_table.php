<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTokenColumnInLoginTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('login_tokens', function (Blueprint $table) {
            $table->dropUnique(['token']); 
            $table->integer('token')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('login_tokens', function (Blueprint $table) {
            $table->string('token')->unique()->change(); // Revert back to string and add unique constraint
        });
    }
}
