<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class FloatType extends Type
{
    public const NAME = 'float';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'float';
    }
}
