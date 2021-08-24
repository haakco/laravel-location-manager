<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



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
 * @property \App\Models\Country $country
 * @property \App\Models\County $county
 * @package App\Models
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
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function county()
    {
        return $this->belongsTo(\App\Models\County::class, 'county_id');
    }
}
