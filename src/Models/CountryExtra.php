<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class CountryExtra
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property string $json_data
 * @property \App\Models\Country $country
 * @package App\Models
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
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }
}
