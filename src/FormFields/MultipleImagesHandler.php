<?php

namespace TopSystem\TopAdmin\FormFields;

class MultipleImagesHandler extends AbstractHandler
{
    protected $codename = 'multiple_images';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('admin::formfields.multiple_images', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
