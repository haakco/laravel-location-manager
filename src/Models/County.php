<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class County
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $country_id
 * @property string $name
 * @property \HaakCo\LocationManager\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\City[] $cities_county
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Address[] $addresses_county
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperCounty
 */
class County extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'counties';

    protected $casts = [
        'country_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'name'
    ];

    public function country()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Country::class, 'country_id');
    }

    public function cities_county()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\City::class, 'county_id');
    }

    public function addresses_county()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\Address::class, 'county_id');
    }
}
