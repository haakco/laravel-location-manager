<?php

/**
 * Created by Reliese Model.
 */

namespace HaakCo\LocationManager\Models;



/**
 * Class AddressEmail
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $address_id
 * @property int $email_id
 * @property \HaakCo\LocationManager\Models\Address $address
 * @property \HaakCo\LocationManager\Models\Email $email
 * @package App\Models
 * @mixin IdeHelperAddressEmail
 */
class AddressEmail extends \HaakCo\LocationManager\Models\BaseModels\BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'public.address_emails';

    protected $casts = [
        'address_id' => 'int',
        'email_id' => 'int'
    ];

    protected $fillable = [
        'address_id',
        'email_id'
    ];

    public function address()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Address::class, 'address_id');
    }

    public function email()
    {
        return $this->belongsTo(\HaakCo\LocationManager\Models\Email::class, 'email_id');
    }
}
