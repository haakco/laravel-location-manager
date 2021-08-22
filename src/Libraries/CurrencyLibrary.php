<?php

namespace HaakCo\LocationManager;

use  HaakCo\LocationManager\Models\Currency;
use Illuminate\Support\Facades\Log;
use NumberFormatter;
use PragmaRX\Coollection\Package\Coollection;
use PragmaRX\Countries\Package\Countries;

use function app_path;
use function array_key_exists;

class CurrencyLibrary
{
    private string $iso4217File = '/Libraries/Helper/CurrencyData/ISO_4217_2018-08-29.xml';
    /**
     * @var Countries
     */
    private Countries $countries;

    private array $iso4217Currencies;

    public function __construct()
    {
        $this->countries = new Countries();
        $this->iso4217Currencies = $this->loadIso4217Currencies();
    }

    /**
     * @return mixed
     */
    private function loadIso4217Currencies(): array
    {
        $xmlObject =
            simplexml_load_string(
                file_get_contents(app_path() . $this->iso4217File)
            );
        $result = [];
        foreach ($xmlObject->CcyTbl->children() as $ccyNtry) {
            $result[(string)$ccyNtry->Ccy] = (array)$ccyNtry;
        }
        return $result;
    }

    public function getAllCurrencies(): void
    {
        $currencyKeys =
            $this->countries->currencies()
                ->keys();
        foreach ($currencyKeys as $keys) {
            $this->getCurrencyFromCode($keys);
        }
    }

    /** @noinspection PhpUndefinedMethodInspection */

    /**
     * @param string $currencyThreeCode
     * @param string|null $countryCode
     * @param string $locale
     *
     * @return mixed
     * @noinspection PhpUndefinedFieldInspection
     * @noinspection PhpUndefinedMethodInspection
     */
    public function getCurrencyFromCode(string $currencyThreeCode, ?string $countryCode = null, string $locale = 'en')
    {
        $currency = Currency::query()
            ->where('code', $currencyThreeCode)
            ->first();

        if (!($currency instanceof Currency)) {
            /**
             * @var Coollection $currencyData
             */
            $currencyData =
                $this->countries->currencies()
                    ->where('iso.code', $currencyThreeCode)
                    ->first();

            $currency = new Currency();
            if ($currencyData === null || !isset($currencyData->units)) {
                Log::error(
                    "Error: Currency Can't find currency in library trying iso 4217 xml",
                    [
                        'currencyCode' => $currencyThreeCode,
                        'countryCode' => $countryCode,
                    ]
                );
                if (!array_key_exists($currencyThreeCode, $this->iso4217Currencies) === true) {
                    Log::error(
                        'Error: Currency unknown currency code',
                        [
                            'currencyCode' => $currencyThreeCode,
                            'countryCode' => $countryCode,
                        ]
                    );
                    return false;
                }
                $simpleData = $this->iso4217Currencies[$currencyThreeCode];
                $currency->symbol = $this->getCurrencySymbol($currencyThreeCode, $locale);
                $currency->locale_symbol = $this->getCurrencySymbol($currencyThreeCode, $locale);
                $currency->en_symbol = $this->getCurrencySymbol($currencyThreeCode, 'en');
                $currency->code = $currencyThreeCode;
                $currency->numeric_code = $simpleData['CcyNbr'];
                $currency->name = $simpleData['CcyNm'];
                $currency->full_name = $simpleData['CcyNm'];
                $currency->minor_name = '';
                $currency->minor_symbol = '';
                $currency->smallest_value_text = '0.' .
                    str_pad(
                        '',
                        $simpleData['CcyMnrUnts'] - 1,
                        "0"
                    );
                $currency->decimal_places = $simpleData['CcyMnrUnts'];
            } else {
                $currency->symbol = $currencyData->units->major->symbol;
                $currency->locale_symbol = $this->getCurrencySymbol($currencyThreeCode, $locale);
                $currency->en_symbol = $this->getCurrencySymbol($currencyThreeCode, 'en');
                $currency->code = $currencyData->iso->code;
                $currency->numeric_code = $currencyData->iso->number;
                $currency->name = $currencyData->units->major->name;
                $currency->full_name = $currencyData->name;
                $currency->minor_name = $currencyData->units->minor->name;
                $currency->minor_symbol = $currencyData->units->minor->symbol;
                $currency->smallest_value_text = (string)$currencyData->units->minor->majorValue;
                $currency->decimal_places = strlen(substr(strrchr($currencyData->units->minor->majorValue, "."), 1));
            }
        }
        $currency->save();
        return $currency;
    }

    /**
     * @param $currencyCode
     * @param string $locale
     *
     * @return false|string
     */
    public function getCurrencySymbol($currencyCode, $locale = 'en_UK'): string
    {
        $formatter = new NumberFormatter($locale . '@currency=' . $currencyCode, NumberFormatter::CURRENCY);
        return $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
    }
}
