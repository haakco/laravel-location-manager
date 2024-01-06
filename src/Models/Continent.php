<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use App\Models\BaseModels\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Continent.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property string $name
 * @property Collection|Country[] $countries
 */
class Continent extends BaseModel
{
    use SoftDeletes;

    protected $table = 'continents';

    protected $fillable = ['name'];

    /**
     * @return HasMany|Country[]
     */
    public function countries(): HasMany|array
    {
        return $this->hasMany(Country::class, 'continent_id');
    }
}
