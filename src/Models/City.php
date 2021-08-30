<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property int $country_id
 * @property int $county_id
 * @property string $name
 * @property Country $country
 * @property County $county
 */
class City extends BaseModel
{
    use SoftDeletes;

    protected $table = 'cities';

    protected $casts = [
        'country_id' => 'int',
        'county_id' => 'int',
    ];

    protected $fillable = ['country_id', 'county_id', 'name'];

    public function country(): BelongsTo|Country
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function county(): BelongsTo|County
    {
        return $this->belongsTo(County::class, 'county_id');
    }
}
