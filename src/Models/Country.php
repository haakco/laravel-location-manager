<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country.
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property int $continent_id
 * @property bool $is_active
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
 * @property Collection|CountryCurrency[] $currenciesCountry
 * @property Collection|CountryExtra[] $countryExtras
 * @property Collection|County[] $counties
 * @property Collection|Language[] $languages
 * @property Collection|CountryLanguage[] $countryLanguages
 * @property Collection|Timezone[] $timezones
 * @property Collection|CountryTimezone[] $countryTimezones
 * @property City[]|Collection $cities
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
        'longitude_min' => 'decimal:6',
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
        'longitude_min',
    ];

    public function continent(): BelongsTo|Continent
    {
        return $this->belongsTo(Continent::class, 'continent_id');
    }

    /**
     * @return HasMany
     */
    public function currenciesCountry(): HasMany
    {
        return $this->hasMany(CountryCurrency::class, 'country_id');
    }

    /**
     * @return HasMany|CountryExtra[]
     */
    public function countryExtras(): HasMany|array
    {
        return $this->hasMany(CountryExtra::class, 'country_id');
    }

    /**
     * @return HasMany|County[]
     */
    public function counties(): HasMany|array
    {
        return $this->hasMany(County::class, 'country_id');
    }

    /**
     * @return BelongsToMany|Language[]
     */
    public function languages(): BelongsToMany|array
    {
        return $this->belongsToMany(Language::class, 'country_languages', 'country_id')
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * @return HasMany|CountryLanguage[]
     */
    public function countryLanguages(): HasMany|array
    {
        return $this->hasMany(CountryLanguage::class, 'country_id');
    }

    /**
     * @return BelongsToMany|Timezone[]
     */
    public function timezones(): BelongsToMany|array
    {
        return $this->belongsToMany(Timezone::class, 'country_timezones', 'country_id')
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * @return HasMany|CountryTimezone[]
     */
    public function countryTimezones(): HasMany|array
    {
        return $this->hasMany(CountryTimezone::class, 'country_id');
    }

    /**
     * @return HasMany|City[]
     */
    public function cities(): HasMany|array
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
