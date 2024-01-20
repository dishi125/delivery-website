<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Dimensions extends Enum
{
    const Centimeter =   0;
    const Meter =   1;
    const Inches = 2;
    const Feet = 3;
}
