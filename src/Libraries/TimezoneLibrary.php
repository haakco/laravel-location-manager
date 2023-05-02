<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Libraries;

use DateTimeZone;
use HaakCo\LocationManager\Models\Timezone;
use IntlTimeZone;

class TimezoneLibrary
{
    public function addAllTimezones(): void
    {
        $tzList = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        foreach ($tzList as $tzName) {
            $this->getTimezone($tzName);
        }
    }

    public function getTimezone(string $tzName): Timezone
    {
        $timeZone =
            Timezone::query()
                ->where('name', $tzName)
                ->first();

        if (! ($timeZone instanceof Timezone)) {
            $timeZone = new Timezone();
            $timeZone->name = $tzName;
        }
        $tz = IntlTimeZone::createTimeZone($tzName);

        if ($tz instanceof IntlTimeZone) {
            $timeZone->is_day_light_saving = $tz->useDaylightTime();
            $timeZone->display_name = $tz->getDisplayName();
            $timeZone->raw_offset = $tz->getRawOffset();
            // @noinspection PhpRedundantOptionalArgumentInspection
            $timeZone->raw_offset_minutes = round($tz->getRawOffset() / 1000 / 60, 0);
            $timeZone->day_light_display_name = $timeZone->is_day_light_saving ? $tz->getDisplayName(true) : '';
            $timeZone->day_light_raw_offset = $timeZone->is_day_light_saving ? $tz->getDSTSavings() : 0;
            // @noinspection PhpRedundantOptionalArgumentInspection
            $timeZone->day_light_raw_offset_minutes =
                $timeZone->is_day_light_saving ? round($tz->getDSTSavings() / 1000 / 60, 0) : 0;
            $timeZone->save();
        }

        return $timeZone;
    }
}
