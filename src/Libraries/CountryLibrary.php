<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Libraries;

use HaakCo\LocationManager\Models\Continent;
use HaakCo\LocationManager\Models\Country;
use HaakCo\LocationManager\Models\CountryCurrency;
use HaakCo\LocationManager\Models\CountryLanguage;
use HaakCo\LocationManager\Models\CountryTimezone;
use HaakCo\LocationManager\Models\Currency;
use HaakCo\LocationManager\Models\Enums\ContinentsEnum;
use HaakCo\LocationManager\Models\Language;
use Illuminate\Support\Facades\Log;
use PragmaRX\Countries\Package\Countries;
use RuntimeException;

use function array_values;
use function strtoupper;

class CountryLibrary
{
    private CurrencyLibrary $currencyLibrary;

    private TimezoneLibrary $timezoneLibrary;

    private Countries $countries;

    private array $ignoreCodes = [
        'EU' => 'Europe Union',
    ];

    private array $missingFlags = [
        'TK' => '🇹🇰',
        'BQ' => '🇧🇶',
        'BV' => '🇧🇻',
        'CC' => '🇨🇨',
        'CX' => '🇨🇽',
        'GP' => '🇬🇵',
        'GF' => '🇬🇫',
        'MQ' => '🇲🇶',
        'YT' => '🇾🇹',
        'RE' => '🇷🇪',
        'SJ' => '🇸🇯',
    ];

    public function __construct()
    {
        $this->currencyLibrary = new CurrencyLibrary();
        $this->timezoneLibrary = new TimezoneLibrary();
        $this->countries = new Countries();
    }

    public function getAllCountries(): void
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $countryCodes =
            $this->countries->all()
                ->pluck('cca2');
        foreach ($countryCodes as $countryCode) {
            if (\strlen($countryCode) === 2) {
                if (isset($this->ignoreCodes[$countryCode])) {
                    Log::error('Error: Country ignoring from ignore list', [
                        'countryCode' => $countryCode,
                        'name' => $this->ignoreCodes[$countryCode],
                    ]);
                } else {
                    $this->getCountryFrom2LetterCode($countryCode);
                }
            } else {
                Log::error('Error: Country ignoring all none 2 letter codes', [
                    'countryCode' => $countryCode,
                ]);
            }
        }
    }

    public function getCountryFrom2LetterCode(string $countryCode): ?Country
    {
        if ($countryCode === 'EU') {
            Log::error('Error: Eu is not a country', [
                'countryCode' => $countryCode,
            ]);

            throw new RuntimeException('Eu is not a country');
        }
        $countryCode = strtoupper($countryCode);
        $country =
            Country::query()
                ->where('iso_code', $countryCode)
                ->first();

        /** @noinspection PhpUndefinedMethodInspection */
        $countryInfo =
            $this->countries->where('cca2', $countryCode)
                ->first();
        if (! ($country instanceof Country)) {
            $continentId = ContinentsEnum::NONE_ID;
            if (isset($countryInfo->geo['continent']) && \is_array($countryInfo->geo['continent'])) {
                $continent = $this->getContinent(array_values($countryInfo->geo['continent'])[0]);
                if ($continent instanceof Continent) {
                    $continentId = $continent->id;
                }
            } else {
                Log::error('Error: Country has no continents', [
                    'countryCode' => $countryCode,
                ]);
            }

            $country = new Country();
            $country->continent_id = $continentId;
            if ((string) $countryInfo->cca2 === 'XK') {
                $ccn3 = 383;
            } else {
                try {
                    $ccn3 = (int) $countryInfo->ccn3;
                    if ($ccn3 === 0) {
                        $ccn3 = null;
                        Log::error('Error: Country has invalid ccn3', [
                            'countryCode' => $countryCode,
                        ]);
                    }
                } catch (RuntimeException $exception) {
                    $ccn3 = null;
                    Log::error('Error: Country has no ccn3', [
                        'countryCode' => $countryCode,
                    ]);
                }
            }

            if (isset($countryInfo->flag->emoji) && \is_string($countryInfo->flag->emoji)) {
                $emoji = $countryInfo->flag->emoji;
            } elseif (isset($this->missingFlags[$countryCode])) {
                $emoji = $this->missingFlags[$countryCode];
            } else {
                $emoji = null;
                Log::error('Error: Country missing emoji flag', [
                    'countryCode' => $countryCode,
                ]);
            }
            $country->iso_code = (string) $countryInfo->cca2;
            $country->iso_three_code = (string) $countryInfo->cca3;
            $country->iso_numeric = $ccn3;
            $country->emoji = $emoji;
            $country->latitude = (float) ($countryInfo->geo['latitude_desc'] ?? 0);
            $country->longitude = (float) ($countryInfo->geo['longitude_desc'] ?? 0);
            $country->latitude_max = (float) ($countryInfo->geo['max_latitude'] ?? 0);
            $country->latitude_min = (float) ($countryInfo->geo['min_latitude'] ?? 0);
            $country->longitude_max = (float) ($countryInfo->geo['max_longitude'] ?? 0);
            $country->longitude_min = (float) ($countryInfo->geo['min_longitude'] ?? 0);
        }
        $country->name = (string) $countryInfo->name['common'];
        if (isset($countryInfo->name['official']) &&
            \is_string($countryInfo->name['official']) &&
            $countryInfo->name['official'] !== '') {
            $officialName = $countryInfo->name['official'];
        } else {
            $officialName = (string) $countryInfo->name['common'];
            Log::error('Error: Country missing official name', [
                'countryCode' => $countryCode,
            ]);
        }
        $country->official_name = $officialName;
        $country->save();
        $country = Country::firstWhere('iso_code', $countryCode);

        // @noinspection MissingIssetImplementationInspection
        if (! isset($countryInfo->currencies)) {
            Log::error('Error: Country missing currencies', [
                'countryCode' => $countryCode,
            ]);
        } else {
            foreach ($countryInfo->currencies as $currencyKey => $currencyThreeCode) {
                if (! \is_string($currencyThreeCode)) {
                    $currencyThreeCode = $currencyKey;
                }
                $languageCode =
                    $countryInfo->languages->keys()
                        ->first();
                $currency = $this->currencyLibrary->getCurrencyFromCode(
                    $currencyThreeCode,
                    $countryCode,
                    $languageCode.'_'.$country->iso_code
                );

                if ($currency instanceof Currency) {
                    CountryCurrency::firstOrCreate([
                        'currency_id' => $currency->id,
                        'country_id' => $country->id,
                    ]);
                }
            }
        }

        // @noinspection MissingIssetImplementationInspection
        if (! isset($countryInfo->languages)) {
            Log::error('Error: Country missing languages', [
                'countryCode' => $countryCode,
            ]);
        } else {
            foreach ($countryInfo->languages as $threeCode => $languageName) {
                $language = $this->getLanguage($threeCode, $languageName);

                if ($language instanceof Language) {
                    CountryLanguage::firstOrCreate([
                        'country_id' => $country->id,
                        'language_id' => $language->id,
                    ]);
                } else {
                    Log::error("Error: Country can't find language", [
                        'language_three_letter_code' => $threeCode,
                        'language_name' => $languageName,
                    ]);
                }
            }
        }

        // @noinspection PhpUndefinedMethodInspection
        foreach ($countryInfo->hydrate('timezones')->timezones as $timezone) {
            $timezone = $this->timezoneLibrary->getTimezone($timezone['zone_name']);

            CountryTimezone::firstOrCreate([
                'country_id' => $country->id,
                'timezone_id' => $timezone->id,
            ]);
        }

        return $country;
    }

    public function getContinent(string $name): Continent
    {
        $continent =
            Continent::query()
                ->where('name', $name)
                ->first();

        if (! ($continent instanceof Continent)) {
            $continent = new Continent();
            $continent->name = $name;
            $continent->save();
        }

        return $continent;
    }

    public function getLanguage(string $threeCode, string $name): Language
    {
        $language =
            Language::query()
                ->where('three_letter_code', $threeCode)
                ->first();
        if (! $language instanceof Language) {
            $language = new Language();
            $language->name = $name;
            $language->three_letter_code = $threeCode;
            $language->save();
        }
        if ($language->name !== $name) {
            $language->name = $name;
        }
        $language->save();

        return $language;
    }
}
