<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class AddressExtra
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $address_id
 * @property array $data_json
 * @property \HaakCo\LocationManager\Models\Address $address
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperAddressExtra
 */
class AddressExtra extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    protected $table = 'address_extra';

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
        return $this->belongsTo(\HaakCo\LocationManager\Models\Address::class, 'address_id');
    }
}
