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
 * @property \App\Models\AttributeDropdownOption $country
 * @property \App\Models\Language $language
 * @property \App\Models\AttributeDropdownOption $attribute_dropdown_option
 * @package App\Models
 * @mixin IdeHelperCountryLanguage
 */
class CountryLanguage extends \App\Models\BaseModels\BaseModel
{
    protected $table = 'public.country_languages';

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
        return $this->belongsTo(\App\Models\AttributeDropdownOption::class, 'country_id');
    }

    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class, 'language_id');
    }

    public function attribute_dropdown_option()
    {
        return $this->belongsTo(\App\Models\AttributeDropdownOption::class, 'attribute_dropdown_option_id');
    }
}
