<?php

namespace TopSystem\TopAdmin\Database\Types\Postgresql;

use TopSystem\TopAdmin\Database\Types\Common\DoubleType;

class DoublePrecisionType extends DoubleType
{
    public const NAME = 'double precision';
    public const DBTYPE = 'float8';
}
