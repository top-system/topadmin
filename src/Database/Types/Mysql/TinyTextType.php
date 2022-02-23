<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class TinyTextType extends Type
{
    public const NAME = 'tinytext';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'tinytext';
    }
}
