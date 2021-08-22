<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class AddressType
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses_address_type
 * @package App\Models
 * @mixin IdeHelperAddressType
 */
class AddressType extends \App\Models\BaseModels\BaseModel
{
    protected $table = 'public.address_types';

    protected $fillable = [
        'name'
    ];

    public function addresses_address_type()
    {
        return $this->hasMany(\App\Models\Address::class, 'address_type_id');
    }
}
