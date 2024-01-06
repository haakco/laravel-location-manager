<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
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
    public function down(): void
    {
        DB::unprepared(
            file_get_contents(
                __DIR__.'/2020_01_01_000001_add_unknown_data_down.sql'
            )
        );
    }
};
