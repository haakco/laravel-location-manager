<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class Language
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $code
 * @property string $three_letter_code
 * @property string $name
 * @property string $local_name
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Country[] $countries
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryLanguage[] $country_languages_language
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperLanguage
 */
class Language extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'languages';

    protected $fillable = [
        'code',
        'three_letter_code',
        'name',
        'local_name'
    ];

    public function countries()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\Country::class, 'public.country_languages', 'language_id', 'attribute_dropdown_option_id')
                    ->withPivot('id', 'country_id')
                    ->withTimestamps();
    }

    public function country_languages_language()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryLanguage::class, 'language_id');
    }
}
