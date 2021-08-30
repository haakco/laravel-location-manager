<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;

/**
 * Class CountryCurrency.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $country_id
 * @property int $currency_id
 * @property Country $country
 * @property Currency $currency
 */
class CountryCurrency extends BaseModel
{
    protected string $table = 'country_currencies';

    protected array $casts = [
        'country_id' => 'int',
        'currency_id' => 'int',
    ];

    protected array $fillable = ['country_id', 'currency_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
