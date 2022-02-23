<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class YearType extends Type
{
    public const NAME = 'year';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'year';
    }
}
