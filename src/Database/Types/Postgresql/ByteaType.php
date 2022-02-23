<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class ByteaType extends Type
{
    public const NAME = 'bytea';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'bytea';
    }
}
