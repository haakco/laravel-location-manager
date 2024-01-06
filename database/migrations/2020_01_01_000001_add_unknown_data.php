<?php

use Illuminate\Database\Migrations\Migration;

class HaakcoLaravelLocationManagerLocationData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            file_get_contents(
                __DIR__.'/2020_01_01_000001_add_unknown_data_up.sql'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(
            file_get_contents(
                __DIR__.'/2020_01_01_000001_add_unknown_data_down.sql'
            )
        );
    }
}
