<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;

use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AddressPhoneNumber
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $address_id
 * @property int $user_phone_id
 * @property Address $address
 * @package HaakCo\LocationManager\Models
 */
class AddressPhoneNumber extends BaseModel
{
    use SoftDeletes;



    protected $table = 'address_phone_numbers';

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
        return $this->belongsTo(Address::class, 'address_id');
    }
}
