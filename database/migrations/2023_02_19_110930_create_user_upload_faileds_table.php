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
        Schema::create('user_upload_faileds', function (Blueprint $table) {
            $table->id();
            $table->string('uid_id');
            $table->string('up3_id');
            $table->string('ulp_id');
            $table->string('user_name');
            $table->string('rbm_code');
            $table->string('name');
            $table->string('phone');
            $table->string('type');
            $table->string('position');
            $table->string('role');
            $table->string('reason');
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
        Schema::dropIfExists('user_upload_faileds');
    }
};
