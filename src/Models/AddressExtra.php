<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class AddressExtra
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $address_id
 * @property array $data_json
 * @property \App\Models\Address $address
 * @package App\Models
 * @mixin IdeHelperAddressExtra
 */
class AddressExtra extends \App\Models\BaseModels\BaseModel
{
    protected $table = 'public.address_extra';

    protected $casts = [
        'address_id' => 'int',
        'data_json' => 'array'
    ];

    protected $fillable = [
        'address_id',
        'data_json'
    ];

    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'address_id');
    }
}
