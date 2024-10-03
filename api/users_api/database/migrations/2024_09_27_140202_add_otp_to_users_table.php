<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtpToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'otp')) {
        Schema::table('users', function (Blueprint $table) {
            // Add the otp column with a string data type and nullable option
            $table->string('otp')->nullable()->after('mobile');
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the otp column if the migration is rolled back
            $table->dropColumn('otp');
        });
    }
}
