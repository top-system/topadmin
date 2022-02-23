<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use TopSystem\TopAdmin\Database\Types\Common\CharType;

class CharacterType extends CharType
{
    public const NAME = 'character';
    public const DBTYPE = 'bpchar';
}
