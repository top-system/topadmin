<?php

namespace TopSystem\TopAdmin\FormFields;

class TimeHandler extends AbstractHandler
{
    protected $codename = 'time';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin::formfields.time', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
