<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class PhoneNumberExtra
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $phone_number_id
 * @property array $data_json
 * @property \App\Models\PhoneNumber $phone_number
 * @package App\Models
 * @mixin IdeHelperPhoneNumberExtra
 */
class PhoneNumberExtra extends \App\Models\BaseModels\BaseModel
{
    protected $table = 'public.phone_number_extra';

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
        return $this->belongsTo(\App\Models\PhoneNumber::class, 'phone_number_id');
    }
}
