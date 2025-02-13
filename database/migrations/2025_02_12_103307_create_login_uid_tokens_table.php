<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginUidTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_uid_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('uid'); // Store the UID
            $table->string('email'); // Store the email retrieved from UID API
            $table->string('token', 6); // Store the 6-digit OTP
            $table->timestamp('expires_at'); // Expiry time for the OTP
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
        Schema::dropIfExists('login_uid_tokens');
    }
}
