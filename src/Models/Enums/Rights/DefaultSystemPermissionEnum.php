<?php

namespace App\Models\Enums\Rights;

class DefaultSystemPermissionEnum
{
    public const SYSTEM_PERMISSION_IS_SUPER_ADMIN = [
        'id' => 1,
        'name' => 'Super Admin',
    ];

    public const SYSTEM_PERMISSION_IS_SYSTEM_USER = [
        'id' => 2,
        'name' => 'System User',
    ];

    public const SYSTEM_PERMISSION_ARRAY = [
        self::SYSTEM_PERMISSION_IS_SUPER_ADMIN,
        self::SYSTEM_PERMISSION_IS_SYSTEM_USER,
    ];
}
