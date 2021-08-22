<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

/**
 * Class Country
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property int $continent_id
 * @property boolean $is_active
 * @property string $iso_code
 * @property string $iso_three_code
 * @property int $iso_numeric
 * @property string $name
 * @property string $official_name
 * @property string $emoji
 * @property float $latitude
 * @property float $longitude
 * @property float $latitude_max
 * @property float $latitude_min
 * @property float $longitude_max
 * @property float $longitude_min
 * @property Continent $continent
 * @property Collection|PhoneNumber[] $phone_numbers_country
 * @property Collection|County[] $counties_country
 * @property Collection|City[] $cities_country
 * @property Collection|CountryCurrency[] $country_currencies_country
 * @property Collection|Address[] $addresses_country
 * @property Collection|CountryExtra[] $country_extras_country
 * @property Collection|Language[] $languages
 * @property Collection|CountryLanguage[] $country_languages_country
 * @property Collection|CountryLanguage[] $country_languages_attribute_dropdown_option
 * @property Collection|Timezone[] $timezones
 * @property Collection|CountryTimezone[] $country_timezones_country
 * @package HaakCo\LocationManager\Models
 */
class Country extends BaseModel
{
    use SoftDeletes;


    protected $table = 'countries';

    protected $casts = [
        'continent_id' => 'int',
        'is_active' => 'boolean',
        'iso_numeric' => 'int',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'latitude_max' => 'decimal:6',
        'latitude_min' => 'decimal:6',
        'longitude_max' => 'decimal:6',
        'longitude_min' => 'decimal:6'
    ];

    protected $fillable = [
        'continent_id',
        'is_active',
        'iso_code',
        'iso_three_code',
        'iso_numeric',
        'name',
        'official_name',
        'emoji',
        'latitude',
        'longitude',
        'latitude_max',
        'latitude_min',
        'longitude_max',
        'longitude_min'
    ];

    public function continent()
    {
        return $this->belongsTo(Continent::class, 'continent_id');
    }

    public function phone_numbers_country()
    {
        return $this->hasMany(PhoneNumber::class, 'country_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'public.user_country', 'country_id')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function counties_country()
    {
        return $this->hasMany(County::class, 'country_id');
    }

    public function cities_country()
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public function country_currencies_country()
    {
        return $this->hasMany(CountryCurrency::class, 'country_id');
    }

    public function addresses_country()
    {
        return $this->hasMany(Address::class, 'country_id');
    }

    public function country_extras_country()
    {
        return $this->hasMany(CountryExtra::class, 'country_id');
    }

    public function languages()
    {
        return $this->belongsToMany(
            Language::class,
            'public.country_languages',
            'attribute_dropdown_option_id'
        )
            ->withPivot('id', 'country_id')
            ->withTimestamps();
    }

    public function country_languages_country()
    {
        return $this->hasMany(CountryLanguage::class, 'country_id');
    }

    public function country_languages_attribute_dropdown_option()
    {
        return $this->hasMany(CountryLanguage::class, 'attribute_dropdown_option_id');
    }

    public function timezones()
    {
        return $this->belongsToMany(
            Timezone::class,
            'public.country_timezones',
            'country_id'
        )
            ->withPivot('id')
            ->withTimestamps();
    }

    public function country_timezones_country()
    {
        return $this->hasMany(CountryTimezone::class, 'country_id');
    }
}
