<?php

namespace App\Models\Enums\Rights;

class DefaultSystemRolesEnum
{

    public const SYSTEM_ROLE_SUPER_ADMIN = [
        'id' => 1,
        'name' => 'Super Admin',
        'permissions' => [
            DefaultSystemPermissionEnum::SYSTEM_PERMISSION_IS_SUPER_ADMIN,
        ]
    ];

    //All system users must have this role
    public const SYSTEM_ROLE_USER = [
        'id' => 2,
        'name' => 'System User',
        'permissions' => [
            DefaultSystemPermissionEnum::SYSTEM_PERMISSION_IS_SYSTEM_USER,
        ]
    ];

    public const SYSTEM_ROLE_ARRAY = [
        self::SYSTEM_ROLE_SUPER_ADMIN,
        self::SYSTEM_ROLE_USER,
    ];
}
