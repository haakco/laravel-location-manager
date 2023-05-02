<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property string $code
 * @property string $three_letter_code
 * @property string $name
 * @property string $local_name
 * @property Collection|Country[] $countries
 * @property Collection|CountryLanguage[] $countryLanguages
 */
class Language extends BaseModel
{
    use SoftDeletes;

    protected $table = 'languages';

    protected $fillable = ['code', 'three_letter_code', 'name', 'local_name'];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_languages', 'language_id')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function country_languages_language()
    {
        return $this->hasMany(CountryLanguage::class, 'language_id');
    }
}
