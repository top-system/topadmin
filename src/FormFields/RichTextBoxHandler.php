<?php

namespace TopSystem\TopAdmin\FormFields;

class RichTextBoxHandler extends AbstractHandler
{
    protected $codename = 'rich_text_box';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin::formfields.rich_text_box', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
