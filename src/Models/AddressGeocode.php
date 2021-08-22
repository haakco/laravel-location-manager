<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class AddressGeocode
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $address_id
 * @property double $latitude
 * @property double $longitude
 * @property \App\Models\Address $address
 * @package App\Models
 * @mixin IdeHelperAddressGeocode
 */
class AddressGeocode extends \App\Models\BaseModels\BaseModel
{
    protected $table = 'public.address_geocode';

    protected $casts = [
        'address_id' => 'int',
        'latitude' => 'double',
        'longitude' => 'double'
    ];

    protected $fillable = [
        'address_id',
        'latitude',
        'longitude'
    ];

    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'address_id');
    }
}
