<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;

use Carbon\Carbon;
use HaakCo\PostgresHelper\Models\BaseModels\BaseModel;

/**
 * Class AddressGeocode
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $address_id
 * @property double $latitude
 * @property double $longitude
 * @property Address $address
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperAddressGeocode
 */
class AddressGeocode extends BaseModel
{
    protected $table = 'address_geocode';

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
        return $this->belongsTo(Address::class, 'address_id');
    }
}
