<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class MultiPointType extends Type
{
    public const NAME = 'multipoint';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'multipoint';
    }
}
