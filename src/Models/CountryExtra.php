<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;

/**
 * Class CountryExtra.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $country_id
 * @property string $json_data
 * @property Country $country
 */
class CountryExtra extends BaseModel
{
    protected string $table = 'country_extra';

    protected array $casts = [
        'country_id' => 'int',
    ];

    protected array $fillable = ['country_id', 'json_data'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
