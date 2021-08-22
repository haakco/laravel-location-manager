<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class Continent
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Country[] $countries_continent
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperContinent
 */
class Continent extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'continents';

    protected $fillable = [
        'name'
    ];

    public function countries_continent()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\Country::class, 'continent_id');
    }
}
