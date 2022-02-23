<?php

namespace TopSystem\TopAdmin\Actions;

class RestoreAction extends AbstractAction
{
    public function getTitle()
    {
        return __('admin::generic.restore');
    }

    public function getIcon()
    {
        return 'admin-trash';
    }

    public function getPolicy()
    {
        return 'restore';
    }

    public function getAttributes()
    {
        return [
            'class'   => 'btn btn-sm btn-success pull-right restore',
            'data-id' => $this->data->{$this->data->getKeyName()},
            'id'      => 'restore-'.$this->data->{$this->data->getKeyName()},
        ];
    }

    public function getDefaultRoute()
    {
        return route('admin.'.$this->dataType->slug.'.restore', $this->data->{$this->data->getKeyName()});
    }
}
