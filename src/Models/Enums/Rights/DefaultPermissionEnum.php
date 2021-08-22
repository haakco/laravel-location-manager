<?php

namespace App\Models\Enums\Rights;

class DefaultPermissionEnum
{
    public const PUBLIC_PERMISSION_IS_PUBLIC = [
        'id' => 1,
        'name' => 'Public',
    ];

    public const CLIENT_PERMISSION_IS_OWNER = [
        'id' => 2,
        'name' => 'Owner',
    ];

    public const CLIENT_PERMISSION_IS_CLIENT = [
        'id' => 3,
        'name' => 'User',
    ];

    public const CLIENT_PERMISSION_ARRAY = [
        self::CLIENT_PERMISSION_IS_OWNER,
        self::CLIENT_PERMISSION_IS_CLIENT,
    ];
}
