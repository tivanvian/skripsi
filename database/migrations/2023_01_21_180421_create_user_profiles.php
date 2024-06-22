<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->text('about')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('job_position')->nullable();
            $table->string('gender', 2)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->text('identity_address')->nullable();
            $table->uuid('identity_region_id')->nullable();
            $table->string('office_type')->nullable();
            $table->string('office_name')->nullable();
            $table->text('office_address')->nullable();
            $table->uuid('office_region_id')->nullable();
            $table->string('office_postal_code')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
};
