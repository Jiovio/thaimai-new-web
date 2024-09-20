<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('ecregisters')) {
        Schema::create('ecregisters', function (Blueprint $table) {
            $table->id();
            $table->string('ecfrno', 20)->nullable();
            $table->string('dateecreg', 50)->nullable();
            $table->string('picmeNo', 20)->nullable();
            $table->string('motheraadhaarid', 30)->nullable();
            $table->string('motheraadhaarname', 100)->nullable();
            $table->string('husbandaadhaarid', 30)->nullable();
            $table->string('husbandaadhaarname', 100)->nullable();
            $table->string('motherfullname', 100)->nullable();
            $table->string('motherdob', 50)->nullable();
            $table->string('motherageecreg', 11)->nullable();
            $table->string('motheragemarriage', 11)->nullable();
            $table->string('mothermobno', 20)->nullable();
            $table->string('mobileofperson', 60)->nullable();
            $table->string('motheredustatus', 80)->nullable();
            $table->string('husfullname', 100)->nullable();
            $table->string('husdob', 50)->nullable();
            $table->string('husageecreg', 11)->nullable();
            $table->string('husagemarriage', 11)->nullable();
            $table->string('husmobno', 20)->nullable();
            $table->string('husedustatus', 80)->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('caste', 50)->nullable();
            $table->string('BlockId', 70)->nullable();
            $table->string('PhcId', 100)->nullable();
            $table->string('HscId', 10)->nullable();
            $table->string('PanchayatId', 10)->nullable();
            $table->string('VillageId', 10)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('pincode', 11)->nullable();
            $table->string('povertystatus', 50)->nullable();
            $table->string('migrantstatus', 100)->nullable();
            $table->string('rationcardtype', 40)->nullable();
            $table->string('rationcardnum', 20)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->string('createdBy', 5)->nullable();
            $table->string('updatedat', 20)->nullable();
            $table->string('updatedBy', 5)->nullable();
            $table->string('deletedat', 20)->nullable();
            $table->string('deletedBy', 5)->nullable();
        });
    }
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecregisters');
    }
};
