<?php

namespace App\Enum;

use ArchTech\Enums\Values;

enum GenderEnums: string
{
    use Values;

    case MALE = 'Male';
    case FEMALE = 'Female';
    case OTHER = 'Other';
}
