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
        Schema::create('order_upload_faileds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->string('rbm_code');
            $table->string('uid_id');
            $table->string('up3_id');
            $table->string('ulp_id');
            $table->string('name');
            $table->string('tarif');
            $table->integer('power')->comment('daya');
            $table->string('class')->comment('kode golongan');
            $table->string('substation')->comment('gardu');
            $table->double('bill', 12, 2);
            $table->text('address')->nullable();
            $table->string('reason');
            $table->auditable();
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
        Schema::dropIfExists('order_upload_faileds');
    }
};
