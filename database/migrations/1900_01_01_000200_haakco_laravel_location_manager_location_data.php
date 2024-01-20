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
        PgHelperLibrary::addMissingUpdatedAtTriggers();

        DB::insert(
            "INSERT INTO continents (id, created_at, updated_at, deleted_at, enabled, name)
VALUES
(0, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, false,'None'),
(1, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, true,'Africa'),
(2, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, true, 'Antarctica'),
(3, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, true, 'Australia'),
(4, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, true, 'Asia'),
(5, '2020-09-16 21:45:16', '2020-09-16 21:45:16', null, true, 'Europe'),
(6, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, true, 'North America'),
(7, '2020-09-16 21:50:43', '2020-09-16 21:50:43', null, true, 'Oceania'),
(8, '2020-09-16 21:50:43', '2020-09-16 21:50:43', null, true, 'South America');"
        );

        PgHelperLibrary::setSequenceStart('continents');

        DB::unprepared(
            file_get_contents(
                __DIR__ . '/1900_01_01_000200_location_data_01_timezones.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('timezones');

        DB::unprepared(
            file_get_contents(
                __DIR__ . '/1900_01_01_000200_location_data_02_countries.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('countries');

        DB::unprepared(
            file_get_contents(
                __DIR__ . '/1900_01_01_000200_location_data_03_languages.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('languages');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_04_currencies.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('currencies');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_10_country_timezones.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('country_timezones');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_11_country_languages.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('country_languages');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/1900_01_01_000200_location_data_12_country_currencies.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('country_currencies');
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
