<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class CountryCurrency
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property int $currency_id
 * @property \App\Models\Country $country
 * @property \App\Models\Currency $currency
 * @package App\Models
 * @mixin IdeHelperCountryCurrency
 */
class CountryCurrency extends \App\Models\BaseModels\BaseModel
{
    protected $table = 'public.country_currencies';

    protected $casts = [
        'country_id' => 'int',
        'currency_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'currency_id'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class, 'currency_id');
    }
}
