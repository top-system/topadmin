<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class RealType extends Type
{
    public const NAME = 'real';
    public const DBTYPE = 'float4';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'real';
    }
}
