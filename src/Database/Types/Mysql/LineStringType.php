<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class LineStringType extends Type
{
    public const NAME = 'linestring';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'linestring';
    }
}
