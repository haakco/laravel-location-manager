<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class Country
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
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
 * @property \HaakCo\LocationManager\Models\Continent $continent
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\PhoneNumber[] $phone_numbers_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\MonitorServer[] $monitor_servers_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\UserAttributeDropdown[] $user_attribute_dropdowns_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\UserAttributeDropdown[] $user_attribute_dropdowns_attribute_dropdown_option
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\User[] $users
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\UserCountry[] $user_countries_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\County[] $counties_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\City[] $cities_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryCurrency[] $country_currencies_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Address[] $addresses_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryExtra[] $country_extras_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Language[] $languages
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryLanguage[] $country_languages_country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryLanguage[] $country_languages_attribute_dropdown_option
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Timezone[] $timezones
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\CountryTimezone[] $country_timezones_country
 * @package App\Models
 * @mixin IdeHelperCountry
 */
class Country extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.countries';

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
        return $this->belongsTo(\HaakCo\LocationManager\Models\Continent::class, 'continent_id');
    }

    public function phone_numbers_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\PhoneNumber::class, 'country_id');
    }

    public function monitor_servers_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\MonitorServer::class, 'country_id');
    }

    public function user_attribute_dropdowns_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\UserAttributeDropdown::class, 'country_id');
    }

    public function user_attribute_dropdowns_attribute_dropdown_option()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\UserAttributeDropdown::class, 'attribute_dropdown_option_id');
    }

    public function users()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\User::class, 'public.user_country', 'country_id')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function user_countries_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\UserCountry::class, 'country_id');
    }

    public function counties_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\County::class, 'country_id');
    }

    public function cities_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\City::class, 'country_id');
    }

    public function country_currencies_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryCurrency::class, 'country_id');
    }

    public function addresses_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\Address::class, 'country_id');
    }

    public function country_extras_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryExtra::class, 'country_id');
    }

    public function languages()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\Language::class, 'public.country_languages', 'attribute_dropdown_option_id')
                    ->withPivot('id', 'country_id')
                    ->withTimestamps();
    }

    public function country_languages_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryLanguage::class, 'country_id');
    }

    public function country_languages_attribute_dropdown_option()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryLanguage::class, 'attribute_dropdown_option_id');
    }

    public function timezones()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\Timezone::class, 'public.country_timezones', 'country_id')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function country_timezones_country()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\CountryTimezone::class, 'country_id');
    }
}
