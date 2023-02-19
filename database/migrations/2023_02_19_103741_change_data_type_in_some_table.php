<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE uids MODIFY COLUMN id bigint(20) unsigned NOT NULL;");
        DB::statement("ALTER TABLE up3s MODIFY COLUMN id bigint(20) unsigned NOT NULL;");
        DB::statement("ALTER TABLE ulps MODIFY COLUMN id bigint(20) unsigned NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
