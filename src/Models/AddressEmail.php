<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class AddressEmail
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $address_id
 * @property int $email_id
 * @property \App\Models\Address $address
 * @property \App\Models\Email $email
 * @package App\Models
 * @mixin IdeHelperAddressEmail
 */
class AddressEmail extends \App\Models\BaseModels\BaseModel
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
        return $this->belongsTo(\App\Models\Address::class, 'address_id');
    }

    public function email()
    {
        return $this->belongsTo(\App\Models\Email::class, 'email_id');
    }
}
