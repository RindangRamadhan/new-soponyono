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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->unsignedBigInteger('user_id')
                ->comment('Petugas, di ambil dari users->id');

            $table->unsignedBigInteger('uid_id');
            $table->unsignedBigInteger('up3_id');
            $table->unsignedBigInteger('ulp_id');
            $table->string('phone_number')->nullable();
            $table->string('tarif');
            $table->integer('power')->comment('daya');
            $table->string('class')->comment('kode golongan');
            $table->string('substation')->comment('gardu');
            $table->smallInteger('sheet')->comment('lembar');
            $table->double('bill', 12, 2);
            $table->text('photos')->comment('Multiple images, separated by ","');
            $table->enum('status', ['Open', 'On Progress', 'Done']);
            $table->enum('billing_status', ['Paid', 'Debt', 'Unpaid'])
                ->comment('
                - Paid = Lunas
                - Debt = Hutang (Bertemu pelanggan, janji bayar)
                - Unpaid = Belum Lunas (Tidak ketemu pelanggan)');

            $table->date('due_date')->nullable();
            $table->auditable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('orders');
    }
};
