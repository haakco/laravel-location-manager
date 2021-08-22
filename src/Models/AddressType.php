<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class AddressType
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection|\HaakCo\LocationManager\Models\Address[] $addresses_address_type
 * @package App\Models
 * @mixin IdeHelperAddressType
 */
class AddressType extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    protected $table = 'public.address_types';

    protected $fillable = [
        'name'
    ];

    public function addresses_address_type()
    {
        return $this->hasMany(\HaakCo\LocationManager\Models\Address::class, 'address_type_id');
    }
}
