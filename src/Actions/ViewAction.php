<?php

namespace TopSystem\TopAdmin\Actions;

class ViewAction extends AbstractAction
{
    public function getTitle()
    {
        return __('admin::generic.view');
    }

    public function getIcon()
    {
        return 'admin-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-warning pull-right view',
        ];
    }

    public function getDefaultRoute()
    {
        return route('admin.'.$this->dataType->slug.'.show', $this->data->{$this->data->getKeyName()});
    }
}
