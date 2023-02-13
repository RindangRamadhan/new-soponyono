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
        Schema::create('up3s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid_id');
            $table->string('name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->auditable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('uid_id')
                ->references('id')
                ->on('uids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ulps');
    }
};
