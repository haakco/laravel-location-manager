<?php

use App\Libraries\Helper\PgHelperLibrary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Location extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'timezones',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->boolean('is_day_light_saving')
                    ->index();
                $table->text('name')
                    ->unique();
                $table->text('display_name')
                    ->index();
                $table->unsignedBigInteger('raw_offset')
                    ->index();
                $table->unsignedBigInteger('raw_offset_minutes')
                    ->index();
                $table->text('day_light_display_name')
                    ->default('')
                    ->index();
                $table->unsignedBigInteger('day_light_raw_offset')
                    ->default(0)
                    ->index();
                $table->unsignedBigInteger('day_light_raw_offset_minutes')
                    ->default(0)
                    ->index();
            }
        );

        Schema::create(
            'languages',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->text('code')
                    ->unique()
                    ->nullable();
                $table->text('three_letter_code')
                    ->unique();
                $table->text('name')
                    ->unique();
                $table->text('local_name')
                    ->unique()
                    ->nullable();
            }
        );


        Schema::create(
            'currencies',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->text('symbol')
                    ->index();
                $table->text('locale_symbol')
                    ->index();
                $table->text('en_symbol')
                    ->unique();
                $table->text('code')
                    ->unique();
                $table->unsignedBigInteger('numeric_code')
                    ->unique();
                $table->text('name')
                    ->index();
                $table->text('full_name')
                    ->unique();
                $table->text('minor_name')
                    ->index();
                $table->text('minor_symbol')
                    ->index();
                $table->text('smallest_value_text');
                $table->unsignedBigInteger('decimal_places');
            }
        );

        Schema::create(
            'continents',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->text('name')
                    ->unique();
            }
        );

        Schema::create(
            'countries',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->foreignId('continent_id')
                    ->index()
                    ->constrained('continents')
                    ->onDelete('cascade');
                $table->boolean('is_active')
                    ->default(true)
                    ->index();
                $table->text('iso_code')
                    ->unique();
                $table->text('iso_three_code')
                    ->unique();
                $table->unsignedBigInteger('iso_numeric')
                    ->unique()
                    ->nullable();
                $table->text('name')
                    ->unique();
                $table->text('official_name')
                    ->unique()
                    ->nullable();
                $table->text('emoji')
                    ->nullable()
                    ->index();
                $table->decimal('latitude', 11, 8)
                    ->index();
                $table->decimal('longitude', 11, 8)
                    ->index();
                $table->decimal('latitude_max', 11, 6)
                    ->index();
                $table->decimal('latitude_min', 11, 6)
                    ->index();
                $table->decimal('longitude_max', 11, 6)
                    ->index();
                $table->decimal('longitude_min', 11, 6)
                    ->index();
            }
        );

        Schema::create(
            'country_extra',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('country_id')
                    ->unique()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->jsonb('json_data')
                    ->unique();
            }
        );

        Schema::create(
            'country_timezones',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('country_id')
                    ->index()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->foreignId('timezone_id')
                    ->index()
                    ->constrained('timezones')
                    ->onDelete('cascade');

                $table->unique(
                    [
                        'country_id',
                        'timezone_id',
                    ]
                );
            }
        );

        Schema::create(
            'country_languages',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('country_id')
                    ->constrained('countries')
                    ->index()
                    ->onDelete('cascade');
                $table->foreignId('language_id')
                    ->index()
                    ->constrained('languages')
                    ->onDelete('cascade');

                $table->unique(
                    [
                        'country_id',
                        'language_id',
                    ]
                );
            }
        );

        Schema::create(
            'country_currencies',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('country_id')
                    ->index()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->foreignId('currency_id')
                    ->index()
                    ->constrained('currencies')
                    ->onDelete('cascade');

                $table->unique(
                    [
                        'country_id',
                        'currency_id',
                    ]
                );
            }
        );

        Schema::create(
            'phone_numbers',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('phone_verified_at')
                    ->nullable()
                    ->index();
                $table->foreignId('country_id')
                    ->index()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->boolean('is_checked')
                    ->default(false)
                    ->index();
                $table->boolean('is_valid')
                    ->default(false)
                    ->index();
                $table->text('name')
                    ->unique();
            }
        );

        Schema::create(
            'phone_number_extra',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('phone_number_id')
                    ->unique()
                    ->constrained('phone_numbers')
                    ->onDelete('cascade');
                $table->jsonb('data_json')
                    ->default('{}');
            }
        );

        Schema::create(
            'user_phone_numbers',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->boolean('is_active')
                    ->default(true)
                    ->index();
                $table->foreignId('user_id')
                    ->index()
                    ->constrained('users')
                    ->onDelete('cascade');
                $table->foreignId('phone_number_id')
                    ->index()
                    ->constrained('phone_numbers')
                    ->onDelete('cascade');

                $table->unique(
                    [
                        'user_id',
                        'phone_number_id',
                    ]
                );
            }
        );

        Schema::create(
            'counties',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->foreignId('country_id')
                    ->index()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->text('name')
                    ->index();
                $table->unique(
                    [
                        'country_id',
                        'name',
                    ]
                );
            }
        );

        Schema::create(
            'cities',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable()
                    ->index();
                $table->foreignId('country_id')
                    ->index()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->foreignId('county_id')
                    ->index()
                    ->constrained('counties')
                    ->onDelete('cascade');
                $table->text('name')
                    ->index();

                $table->unique(
                    [
                        'country_id',
                        'county_id',
                        'name',
                    ]
                );
            }
        );

        Schema::create(
            'address_types',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->text('name')
                    ->unique();
            }
        );

        PgHelperLibrary::addMissingUpdatedAtTriggers();
        DB::insert(
            "INSERT INTO address_types (id, name)
VALUES
       (1, 'Postal'),
        (2, 'Billing');"
        );

        PgHelperLibrary::setSequenceStart('address_types');

        Schema::create(
            'addresses',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('deleted_at')
                    ->nullable();
                $table->foreignId('user_id')
                    ->index()
                    ->constrained('users')
                    ->onDelete('cascade');
                $table->foreignId('address_type_id')
                    ->index()
                    ->constrained('address_types')
                    ->onDelete('cascade');
                $table->foreignId('country_id')
                    ->index()
                    ->constrained('countries')
                    ->onDelete('cascade');
                $table->foreignId('county_id')
                    ->index()
                    ->constrained('counties')
                    ->onDelete('cascade');
                $table->foreignId('city_id')
                    ->index()
                    ->constrained('cities')
                    ->onDelete('cascade');
                $table->text('address_name')
                    ->index();
                $table->text('company_name')
                    ->default('')
                    ->index();
                $table->text('street_number')
                    ->index();
                $table->text('street_name')
                    ->index();
                $table->text('complex_name')
                    ->default('')
                    ->index();
                $table->text('complex_number')
                    ->default('')
                    ->index();
                $table->text('city_area')
                    ->index();
                $table->text('postal_code')
                    ->index();

                $table->unique(
                    [
                        'user_id',
                        'address_name',
                    ]
                );
            }
        );

        Schema::create(
            'address_extra',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('address_id')
                    ->unique()
                    ->constrained('addresses')
                    ->onDelete('cascade');
                $table->jsonb('data_json')
                    ->default('{}');
            }
        );

        Schema::create(
            'address_geocode',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestampTz('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->timestampTz('updated_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index();
                $table->foreignId('address_id')
                    ->unique()
                    ->constrained('addresses')
                    ->onDelete('cascade');
                $table->double('latitude')
                    ->index();
                $table->double('longitude')
                    ->index();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_geocode');
        Schema::dropIfExists('address_extra');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('address_types');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('counties');
        Schema::dropIfExists('user_phone_numbers');
        Schema::dropIfExists('phone_number_extra');
        Schema::dropIfExists('phone_numbers');
        Schema::dropIfExists('country_currencies');
        Schema::dropIfExists('country_languages');
        Schema::dropIfExists('country_timezones');
        Schema::dropIfExists('country_extra');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('continents');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('timezones');
    }
}
