<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class CountryLanguage
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $country_id
 * @property int $language_id
 * @property \HaakCo\LocationManager\Models\AttributeDropdownOption $country
 * @property \HaakCo\LocationManager\Models\Language $language
 * @property \HaakCo\LocationManager\Models\AttributeDropdownOption $attribute_dropdown_option
 * @package HaakCo\LocationManager\Models
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
        return $this->belongsTo(\HaakCo\LocationManager\Models\AttributeDropdownOption::class, 'country_id');
    }

    public function language()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Language::class, 'language_id');
    }

    public function attribute_dropdown_option()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\AttributeDropdownOption::class, 'attribute_dropdown_option_id');
    }
}
