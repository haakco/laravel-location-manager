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
            "INSERT INTO continents (id, created_at, updated_at, deleted_at, name)
VALUES
(0, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, 'None'),
(1, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, 'Africa'),
(2, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, 'Antarctica'),
(3, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, 'Australia'),
(4, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, 'Asia'),
(5, '2020-09-16 21:45:16', '2020-09-16 21:45:16', null, 'Europe'),
(6, '2020-09-16 21:50:42', '2020-09-16 21:50:42', null, 'North America'),
(7, '2020-09-16 21:50:43', '2020-09-16 21:50:43', null, 'Oceania'),
(8, '2020-09-16 21:50:43', '2020-09-16 21:50:43', null, 'South America');"
        );

        PgHelperLibrary::setSequenceStart('continents');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_01_timezones.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('timezones');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_02_countries.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('countries');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_03_languages.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('languages');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_04_currencies.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('currencies');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_10_country_timezones.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('country_timezones');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_11_country_languages.sql'
            )
        );

        PgHelperLibrary::setSequenceStart('country_languages');

        DB::unprepared(
            file_get_contents(
                __DIR__.'/2015_07_28_125013_location_data_12_country_currencies.sql'
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
