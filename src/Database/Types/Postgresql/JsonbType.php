<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class JsonbType extends Type
{
    public const NAME = 'jsonb';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'jsonb';
    }
}
