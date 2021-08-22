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
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses_city
 * @package App\Models
 * @mixin IdeHelperCity
 */
class City extends \App\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.cities';

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

    public function addresses_city()
    {
        return $this->hasMany(\App\Models\Address::class, 'city_id');
    }
}
