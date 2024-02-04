<?php

use HaakCo\PostgresHelper\Libraries\PgHelperLibrary;
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
                __DIR__.'/1900_01_01_000200_location_data_010_continents.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_020_timezones.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_030_countries.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_040_languages.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_050_currencies.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_100_country_timezones.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_110_country_languages.sql'
            )
        );

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_120_country_currencies.sql'
            )
        );

        PgHelperLibrary::fixAll();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('country_currencies')
            ->truncate();
        DB::table('country_languages')
            ->truncate();
        DB::table('country_timezones')
            ->truncate();
        DB::table('currencies')
            ->truncate();
        DB::table('languages')
            ->truncate();
        DB::table('countries')
            ->truncate();
        DB::table('timezones')
            ->truncate();
    }
}
