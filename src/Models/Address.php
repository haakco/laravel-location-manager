<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



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
 * @property \App\Models\User $user
 * @property \App\Models\AddressType $address_type
 * @property \App\Models\Country $country
 * @property \App\Models\County $county
 * @property \App\Models\City $city
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\AddressGeocode[] $address_geocodes_address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\AddressPhoneNumber[] $address_phone_numbers_address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\AddressExtra[] $address_extras_address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Email[] $emails
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\AddressEmail[] $address_emails_address
 * @package App\Models
 * @mixin IdeHelperAddress
 */
class Address extends \App\Models\BaseModels\BaseModel
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
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function address_type()
    {
        return $this->belongsTo(\App\Models\AddressType::class, 'address_type_id');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function county()
    {
        return $this->belongsTo(\App\Models\County::class, 'county_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }

    public function address_geocodes_address()
    {
        return $this->hasMany(\App\Models\AddressGeocode::class, 'address_id');
    }

    public function address_phone_numbers_address()
    {
        return $this->hasMany(\App\Models\AddressPhoneNumber::class, 'address_id');
    }

    public function address_extras_address()
    {
        return $this->hasMany(\App\Models\AddressExtra::class, 'address_id');
    }

    public function emails()
    {
        return $this->belongsToMany(\App\Models\Email::class, 'public.address_emails', 'address_id')
                    ->withPivot('id', 'deleted_at')
                    ->withTimestamps();
    }

    public function address_emails_address()
    {
        return $this->hasMany(\App\Models\AddressEmail::class, 'address_id');
    }
}
