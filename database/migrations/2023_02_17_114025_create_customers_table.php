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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid_id')->nullable();
            $table->unsignedBigInteger('up3_id')->nullable();
            $table->unsignedBigInteger('ulp_id')->nullable();
            $table->unsignedBigInteger('id_pel')->nullable();
            $table->string('name');
            $table->string('phone_number');
            $table->string('tarif');
            $table->unsignedInteger('daya')->nullable();
            $table->string('kogol');
            $table->string('gardu');
            $table->text('address')->nullable();
            $table->auditable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('uid_id')
                ->references('id')
                ->on('uids');

            $table->foreign('ulp_id')
                ->references('id')
                ->on('ulps');

            $table->foreign('up3_id')
                ->references('id')
                ->on('up3s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
