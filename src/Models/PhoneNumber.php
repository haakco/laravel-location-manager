<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User;

/**
 * Class PhoneNumber
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $phone_verified_at
 * @property int $country_id
 * @property boolean $is_checked
 * @property boolean $is_valid
 * @property string $name
 * @property Country $country
 * @property Collection|PhoneNumberExtra[] $phone_number_extras_phone_number
 * @package HaakCo\LocationManager\Models
 */
class PhoneNumber extends BaseModel
{
    protected $table = 'phone_numbers';

    protected $casts = [
        'country_id' => 'int',
        'is_checked' => 'boolean',
        'is_valid' => 'boolean'
    ];

    protected $dates = [
        'phone_verified_at'
    ];

    protected $fillable = [
        'phone_verified_at',
        'country_id',
        'is_checked',
        'is_valid',
        'name'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'public.user_phone_numbers',
            'phone_number_id'
        )
            ->withPivot('id', 'deleted_at', 'is_active')
            ->withTimestamps();
    }
}
