<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class CountryExtra
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property string $json_data
 * @property \HaakCo\LocationManager\Models\Country $country
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperCountryExtra
 */
class CountryExtra extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    protected $table = 'country_extra';

    protected $casts = [
        'country_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'json_data'
    ];

    public function country()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Country::class, 'country_id');
    }
}
