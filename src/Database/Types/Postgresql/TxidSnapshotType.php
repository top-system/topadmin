<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use TopSystem\TopAdmin\Database\Types\Type;

class TxidSnapshotType extends Type
{
    public const NAME = 'txid_snapshot';

    public function getSQLDeclaration(array $field, AbstractPlatform $platform)
    {
        return 'txid_snapshot';
    }
}
