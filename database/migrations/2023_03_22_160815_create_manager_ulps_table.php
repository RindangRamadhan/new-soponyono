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
        Schema::create('manager_ulps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->comment('Petugas, di ambil dari users->id');
            $table->unsignedBigInteger('ulp_id');
            $table->string('location');
            $table->auditable();
            $table->timestamps();
            
            $table->foreign('ulp_id')
                ->references('id')
                ->on('ulps');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_ulps');
    }
};
