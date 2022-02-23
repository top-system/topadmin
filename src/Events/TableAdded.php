<?php

namespace TopSystem\TopAdmin\Events;

use Illuminate\Queue\SerializesModels;
use TopSystem\TopAdmin\Database\Schema\Table;

class TableAdded
{
    use SerializesModels;

    public $table;

    public function __construct(Table $table)
    {
        $this->table = $table;

        event(new TableChanged($table->name, 'Added'));
    }
}
