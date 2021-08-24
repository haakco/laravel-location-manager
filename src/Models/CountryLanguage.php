<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class CountryLanguage
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property int $language_id
 * @property \App\Models\Country $country
 * @property \App\Models\Language $language
 * @package App\Models
 * @mixin IdeHelperCountryLanguage
 */
class CountryLanguage extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    protected $table = 'country_languages';

    protected $casts = [
        'country_id' => 'int',
        'language_id' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'language_id'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class, 'language_id');
    }
}
