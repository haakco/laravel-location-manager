<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class CountryTimezone
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property int $timezone_id
 * @property \HaakCo\LocationManager\Models\Country $country
 * @property \HaakCo\LocationManager\Models\Timezone $timezone
 * @package HaakCo\LocationManager\Models
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
        return $this->belongsTo(\HaakCo\LocationManager\Models\Country::class, 'country_id');
    }

    public function timezone()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Timezone::class, 'timezone_id');
    }
}
