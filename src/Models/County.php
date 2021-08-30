<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class County.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property int $country_id
 * @property string $name
 * @property Country $country
 * @property City[]|Collection $cities
 */
class County extends BaseModel
{
    use SoftDeletes;

    protected $table = 'counties';

    protected $casts = [
        'country_id' => 'int',
    ];

    protected $fillable = ['country_id', 'name'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function cities_county()
    {
        return $this->hasMany(City::class, 'county_id');
    }
}
