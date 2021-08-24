<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



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
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\CountryLanguage[] $country_languages_language
 * @package App\Models
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
        return $this->belongsToMany(\App\Models\Country::class, 'country_languages', 'language_id')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function country_languages_language()
    {
        return $this->hasMany(\App\Models\CountryLanguage::class, 'language_id');
    }
}
