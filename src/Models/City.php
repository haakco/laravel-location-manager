<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class City
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $country_id
 * @property int $county_id
 * @property string $name
 * @property \HaakCo\LocationManager\Models\Country $country
 * @property \HaakCo\LocationManager\Models\County $county
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Address[] $addresses_city
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperCity
 */
class City extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'cities';

    protected $casts = [
        'country_id' => 'int',
        'county_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'county_id',
        'name'
    ];

    public function country()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Country::class, 'country_id');
    }

    public function county()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\County::class, 'county_id');
    }

    public function addresses_city()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\Address::class, 'city_id');
    }
}
