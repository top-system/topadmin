<?php

namespace TopSystem\TopAdmin\FormFields;

class TextHandler extends AbstractHandler
{
    protected $codename = 'text';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin::formfields.text', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
