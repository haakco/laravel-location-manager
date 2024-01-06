<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use App\Models\BaseModels\BaseModel;
use Carbon\Carbon;

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
    protected $table = 'country_extra';

    protected $casts = [
        'country_id' => 'int',
    ];

    protected $fillable = ['country_id', 'json_data'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
