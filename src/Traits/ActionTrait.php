<?php

namespace TopSystem\TopAdmin\Traits;

use TopSystem\TopAdmin\Actions\DeleteAction;
use TopSystem\TopAdmin\Actions\EditAction;
use TopSystem\TopAdmin\Actions\RestoreAction;
use TopSystem\TopAdmin\Actions\ViewAction;

trait ActionTrait
{
    protected $actions = [
        DeleteAction::class,
        RestoreAction::class,
        EditAction::class,
        ViewAction::class,
    ];

    public function addAction($action)
    {
        array_push($this->actions, $action);
    }

    public function replaceAction($actionToReplace, $action)
    {
        $key = array_search($actionToReplace, $this->actions);
        $this->actions[$key] = $action;
    }

    public function actions()
    {
        return $this->actions;
    }

}