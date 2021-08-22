<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class PhoneNumber
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $phone_verified_at
 * @property int $country_id
 * @property boolean $is_checked
 * @property boolean $is_valid
 * @property string $name
 * @property \HaakCo\LocationManager\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\User[] $users
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\UserPhoneNumber[] $user_phone_numbers_phone_number
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\PhoneNumberExtra[] $phone_number_extras_phone_number
 * @package App\Models
 * @mixin IdeHelperPhoneNumber
 */
class PhoneNumber extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    protected $table = 'public.phone_numbers';

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
        return $this->belongsTo(\HaakCo\LocationManager\Models\Country::class, 'country_id');
    }

    public function users()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\User::class, 'public.user_phone_numbers', 'phone_number_id')
                    ->withPivot('id', 'deleted_at', 'is_active')
                    ->withTimestamps();
    }

    public function user_phone_numbers_phone_number()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\UserPhoneNumber::class, 'phone_number_id');
    }

    public function phone_number_extras_phone_number()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\PhoneNumberExtra::class, 'phone_number_id');
    }
}
