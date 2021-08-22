<?php

namespace App\Console\Commands;

use App\Libraries\Location\CountryLibrary;
use Illuminate\Console\Command;

class CountryAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country:add {countryCode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a country from a country code';

    /**
     * Execute the console command.
     *
     * @param CountryLibrary $countryLibrary
     *
     * @return int
     */
    public function handle(CountryLibrary $countryLibrary): int
    {
        if ($this->argument('countryCode') === 'all') {
            $countryLibrary->getAllCountries();
        } else {
            $countryLibrary->getCountryFrom2LetterCode($this->argument('countryCode'));
        }
        return 0;
    }
}
