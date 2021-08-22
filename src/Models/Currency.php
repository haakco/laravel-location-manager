<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class Currency
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $symbol
 * @property string $locale_symbol
 * @property string $en_symbol
 * @property string $code
 * @property int $numeric_code
 * @property string $name
 * @property string $full_name
 * @property string $minor_name
 * @property string $minor_symbol
 * @property string $smallest_value_text
 * @property int $decimal_places
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryCurrency[] $country_currencies_currency
 * @package App\Models
 * @mixin IdeHelperCurrency
 */
class Currency extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    protected $table = 'public.currencies';

    protected $casts = [
        'numeric_code' => 'int',
        'decimal_places' => 'int'
    ];

    protected $fillable = [
        'symbol',
        'locale_symbol',
        'en_symbol',
        'code',
        'numeric_code',
        'name',
        'full_name',
        'minor_name',
        'minor_symbol',
        'smallest_value_text',
        'decimal_places'
    ];

    public function country_currencies_currency()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryCurrency::class, 'currency_id');
    }
}
