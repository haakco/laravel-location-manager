<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Currency.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
 * @property Collection|CountryCurrency[] $countryCurrencies
 */
class Currency extends BaseModel
{
    protected $table = 'currencies';

    protected $casts = [
        'numeric_code' => 'int',
        'decimal_places' => 'int',
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
        'decimal_places',
    ];

    public function country_currencies_currency()
    {
        return $this->hasMany(CountryCurrency::class, 'currency_id');
    }
}
