<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class PhoneNumberExtra
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $phone_number_id
 * @property array $data_json
 * @property \HaakCo\LocationManager\Models\PhoneNumber $phone_number
 * @package HaakCo\LocationManager\Models
 * @mixin IdeHelperPhoneNumberExtra
 */
class PhoneNumberExtra extends \HaakCo\PostgresHelper\Models\BaseModels\BaseModel
{
    protected $table = 'phone_number_extra';

    protected $casts = [
        'phone_number_id' => 'int',
        'data_json' => 'array'
    ];

    protected $fillable = [
        'phone_number_id',
        'data_json'
    ];

    public function phone_number()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\PhoneNumber::class, 'phone_number_id');
    }
}
