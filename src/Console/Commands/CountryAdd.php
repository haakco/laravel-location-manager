<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Console\Commands;

use HaakCo\LocationManager\Libraries\CountryLibrary;
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
