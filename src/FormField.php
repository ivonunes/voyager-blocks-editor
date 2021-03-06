<?php

namespace IvoNunes\VoyagerBlocksEditor;

use TCG\Voyager\FormFields\AbstractHandler;

class FormField extends AbstractHandler
{
    protected $codename = 'blocks_editor';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('voyager-blocks-editor::form-field', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
