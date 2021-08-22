<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

/**
 * Class Address
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
 * @property User $user
 * @property AddressType $address_type
 * @property Country $country
 * @property County $county
 * @property City $city
 * @property Collection|AddressGeocode[] $address_geocodes_address
 * @property Collection|AddressPhoneNumber[] $address_phone_numbers_address
 * @property Collection|AddressExtra[] $address_extras_address
 * @property Collection|\HaakCo\LocationManager\Models\Email[] $emails
 * @property Collection|AddressEmail[] $address_emails_address
 * @package HaakCo\LocationManager\Models
 */
class Address extends BaseModel
{
    use SoftDeletes;



    protected $table = 'addresses';

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address_type()
    {
        return $this->belongsTo(AddressType::class, 'address_type_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function county()
    {
        return $this->belongsTo(County::class, 'county_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function address_geocodes_address()
    {
        return $this->hasMany(AddressGeocode::class, 'address_id');
    }

    public function address_phone_numbers_address()
    {
        return $this->hasMany(AddressPhoneNumber::class, 'address_id');
    }

    public function address_extras_address()
    {
        return $this->hasMany(AddressExtra::class, 'address_id');
    }

    public function emails()
    {
        return $this->belongsToMany(\HaakCo\LocationManager\Models\Email::class, 'public.address_emails', 'address_id')
                    ->withPivot('id', 'deleted_at')
                    ->withTimestamps();
    }

    public function address_emails_address()
    {
        return $this->hasMany(AddressEmail::class, 'address_id');
    }
}
