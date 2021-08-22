<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class County
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $country_id
 * @property string $name
 * @property \App\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities_county
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses_county
 * @package App\Models
 * @mixin IdeHelperCounty
 */
class County extends \App\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.counties';

    protected $casts = [
        'country_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'name'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function cities_county()
    {
        return $this->hasMany(\App\Models\City::class, 'county_id');
    }

    public function addresses_county()
    {
        return $this->hasMany(\App\Models\Address::class, 'county_id');
    }
}
