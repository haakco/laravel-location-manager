<?php

namespace App\Console\Commands;

use App\Libraries\Helper\CurrencyLibrary;
use Exception;
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
     * @param CurrencyLibrary $currencyLibrary
     *
     * @return int
     * @throws Exception
     */
    public function handle(CurrencyLibrary $currencyLibrary): int
    {
        if ($this->argument('currency_code') === 'all') {
            $currencyLibrary->getAllCurrencies();
        } else {
            $currencyLibrary->getCurrencyFromCode($this->argument('currency_code'));
        }
        return 0;
    }
}
