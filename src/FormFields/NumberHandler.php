<?php

namespace TopSystem\TopAdmin\FormFields;

class NumberHandler extends AbstractHandler
{
    protected $codename = 'number';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin::formfields.number', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
