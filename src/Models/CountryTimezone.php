<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use App\Models\BaseModels\BaseModel;
use Carbon\Carbon;

/**
 * Class CountryTimezone.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $country_id
 * @property int $timezone_id
 * @property Country $country
 * @property Timezone $timezone
 */
class CountryTimezone extends BaseModel
{
    protected $table = 'country_timezones';

    protected $casts = [
        'country_id' => 'int',
        'timezone_id' => 'int',
    ];

    protected $fillable = ['country_id', 'timezone_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class, 'timezone_id');
    }
}
