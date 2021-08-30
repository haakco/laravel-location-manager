<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Console\Commands;

use  Exception;
use HaakCo\LocationManager\Libraries\CurrencyLibrary;
use Illuminate\Console\Command;

class CurrencyAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:add {currency_code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a currency from a currency code';

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle(CurrencyLibrary $currencyLibrary): int
    {
        if ('all' === $this->argument('currency_code')) {
            $currencyLibrary->getAllCurrencies();
        } else {
            $currencyLibrary->getCurrencyFromCode($this->argument('currency_code'));
        }

        return 0;
    }
}
