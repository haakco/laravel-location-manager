<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class Timezone
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property boolean $is_day_light_saving
 * @property string $name
 * @property string $display_name
 * @property int $raw_offset
 * @property int $raw_offset_minutes
 * @property string $day_light_display_name
 * @property int $day_light_raw_offset
 * @property int $day_light_raw_offset_minutes
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\CountryTimezone[] $country_timezones_timezone
 * @package App\Models
 * @mixin IdeHelperTimezone
 */
class Timezone extends \App\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.timezones';

    protected $casts = [
        'is_day_light_saving' => 'boolean',
        'raw_offset' => 'int',
        'raw_offset_minutes' => 'int',
        'day_light_raw_offset' => 'int',
        'day_light_raw_offset_minutes' => 'int'
    ];

    protected $fillable = [
        'is_day_light_saving',
        'name',
        'display_name',
        'raw_offset',
        'raw_offset_minutes',
        'day_light_display_name',
        'day_light_raw_offset',
        'day_light_raw_offset_minutes'
    ];

    public function countries()
    {
        return $this->belongsToMany(\App\Models\Country::class, 'public.country_timezones', 'timezone_id')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function country_timezones_timezone()
    {
        return $this->hasMany(\App\Models\CountryTimezone::class, 'timezone_id');
    }
}
