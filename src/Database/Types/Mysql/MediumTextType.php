<?php

namespace TopSystem\TopAdmin\Database\Types\Mysql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class MediumTextType extends Type
{
    public const NAME = 'mediumtext';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'mediumtext';
    }
}
