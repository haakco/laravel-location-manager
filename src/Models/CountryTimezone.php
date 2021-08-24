<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class CountryTimezone
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property int $timezone_id
 * @property \App\Models\Country $country
 * @property \App\Models\Timezone $timezone
 * @package App\Models
 * @mixin IdeHelperCountryTimezone
 */
class CountryTimezone extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    protected $table = 'country_timezones';

    protected $casts = [
        'country_id' => 'int',
        'timezone_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'timezone_id'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function timezone()
    {
        return $this->belongsTo(\App\Models\Timezone::class, 'timezone_id');
    }
}
