<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class AddressPhoneNumber
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $address_id
 * @property int $user_phone_id
 * @property \HaakCo\LocationManager\Models\Address $address
 * @property \HaakCo\LocationManager\Models\UserPhoneNumber $user_phone
 * @package App\Models
 * @mixin IdeHelperAddressPhoneNumber
 */
class AddressPhoneNumber extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.address_phone_numbers';

    protected $casts = [
        'address_id' => 'int',
        'user_phone_id' => 'int'
    ];

    protected $fillable = [
        'address_id',
        'user_phone_id'
    ];

    public function address()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Address::class, 'address_id');
    }

    public function user_phone()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\UserPhoneNumber::class, 'user_phone_id');
    }
}
