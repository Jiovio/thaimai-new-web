<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable(); // No default value            
            $table->string('otp')->nullable()->change();
            $table->string('usertype')->default('6'); // Set a default value
            $table->string('HosId')->nullable();
            $table->string('BlockId')->nullable();
            $table->string('PhcId')->nullable();
            $table->string('HscId')->nullable();
            $table->string('PanchayatId')->nullable();
            $table->string('VillageId')->nullable();
            $table->string('encpassword')->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->integer('emailVerified')->default(1); // Default to verified
            $table->integer('phoneVerified')->default(1); // Default to verified
            $table->integer('status')->default(1); // Default to active
            $table->timestamp('lastlogin')->nullable();
            $table->timestamp('createdat')->useCurrent();
            $table->string('createdBy', 5)->nullable(); // Allow null values
            $table->string('updatedat')->nullable();
            $table->string('updatedBy')->nullable();
            $table->string('deletedat')->nullable();
            $table->string('deletedBy')->nullable();
            $table->rememberToken();
            $table->timestamps();
          /*  if (!Schema::hasColumn('users', 'otp')) {
                $table->string('otp')->nullable()->after('mobile');
            } */ 
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
