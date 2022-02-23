<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use TopSystem\TopAdmin\Database\Types\Common\VarCharType;

class CharacterVaryingType extends VarCharType
{
    public const NAME = 'character varying';
    public const DBTYPE = 'varchar';
}
