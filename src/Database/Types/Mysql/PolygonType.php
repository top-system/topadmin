<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class PolygonType extends Type
{
    public const NAME = 'polygon';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'polygon';
    }
}
