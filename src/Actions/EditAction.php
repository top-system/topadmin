<?php

namespace TopSystem\TopAdmin\Actions;

class EditAction extends AbstractAction
{
    public function getTitle()
    {
        return __('admin::generic.edit');
    }

    public function getIcon()
    {
        return 'admin-edit';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right edit',
        ];
    }

    public function getDefaultRoute()
    {
        return route('admin.'.$this->dataType->slug.'.edit', $this->data->{$this->data->getKeyName()});
    }
}
