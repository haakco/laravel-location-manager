<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class Address
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $user_id
 * @property int $address_type_id
 * @property int $country_id
 * @property int $county_id
 * @property int $city_id
 * @property string $address_name
 * @property string $company_name
 * @property string $street_number
 * @property string $street_name
 * @property string $complex_name
 * @property string $complex_number
 * @property string $city_area
 * @property string $postal_code
 * @property \HaakCo\LocationManager\Models\User $user
 * @property \HaakCo\LocationManager\Models\AddressType $address_type
 * @property \HaakCo\LocationManager\Models\Country $country
 * @property \HaakCo\LocationManager\Models\County $county
 * @property \HaakCo\LocationManager\Models\City $city
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\AddressGeocode[] $address_geocodes_address
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\AddressPhoneNumber[] $address_phone_numbers_address
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\AddressExtra[] $address_extras_address
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Email[] $emails
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\AddressEmail[] $address_emails_address
 * @package App\Models
 * @mixin IdeHelperAddress
 */
class Address extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.addresses';

    protected $casts = [
        'user_id' => 'int',
        'address_type_id' => 'int',
        'country_id' => 'int',
        'county_id' => 'int',
        'city_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'address_type_id',
        'country_id',
        'county_id',
        'city_id',
        'address_name',
        'company_name',
        'street_number',
        'street_name',
        'complex_name',
        'complex_number',
        'city_area',
        'postal_code'
    ];

    public function user()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\User::class, 'user_id');
    }

    public function address_type()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\AddressType::class, 'address_type_id');
    }

    public function country()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Country::class, 'country_id');
    }

    public function county()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\County::class, 'county_id');
    }

    public function city()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\City::class, 'city_id');
    }

    public function address_geocodes_address()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\AddressGeocode::class, 'address_id');
    }

    public function address_phone_numbers_address()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\AddressPhoneNumber::class, 'address_id');
    }

    public function address_extras_address()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\AddressExtra::class, 'address_id');
    }

    public function emails()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\Email::class, 'public.address_emails', 'address_id')
                    ->withPivot('id', 'deleted_at')
                    ->withTimestamps();
    }

    public function address_emails_address()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\AddressEmail::class, 'address_id');
    }
}
