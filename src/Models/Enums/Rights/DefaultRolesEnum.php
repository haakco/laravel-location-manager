<?php

namespace App\Models\Enums\Rights;

class DefaultRolesEnum
{
    //Default roles
    public const CLIENT_ROLE_OWNER = [
        'id' => 1,
        'name' => 'Owner',
        'permissions' => [
            DefaultPermissionEnum::CLIENT_PERMISSION_IS_OWNER,
        ]
    ];

    //All system users must have this role
    public const CLIENT_ROLE_USER = [
        'id' => 2,
        'name' => 'User',
        'permissions' => [
            DefaultPermissionEnum::CLIENT_PERMISSION_IS_CLIENT,
        ]
    ];

    public const CLIENT_ROLE_ARRAY = [
        self::CLIENT_ROLE_OWNER,
        self::CLIENT_ROLE_USER,
    ];
}
