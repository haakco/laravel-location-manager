<?php

namespace HaakCo\LocationManager\Console\Commands;

use  HaakCo\LocationManager\Libraries\Location\TimezoneLibrary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TimezoneAddAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timezone:addAll';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds all possible timezones to db';

    /**
     * @param \HaakCo\LocationManager\Libraries\Location\TimeZoneLibrary $timeZoneLibrary
     *
     * @return int
     */
    public function handle(TimezoneLibrary $timeZoneLibrary): int
    {
        Log::info('Console start ' . $this->getName());

        $timeZoneLibrary->addAllTimezones();
        return 0;
    }
}
