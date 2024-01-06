<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use App\Models\BaseModels\BaseModel;

/**
 * Class CountryLanguage.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $country_id
 * @property int $language_id
 * @property Country $country
 * @property Language $language
 */
class CountryLanguage extends BaseModel
{
    protected $table = 'country_languages';

    protected $casts = [
        'country_id' => 'int',
        'language_id' => 'int',
    ];

    protected $fillable = ['country_id', 'language_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
