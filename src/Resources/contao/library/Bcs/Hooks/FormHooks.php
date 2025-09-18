<?php

namespace Bcs\Hooks;

class FormHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onFormSubmit($submittedData, $formData, $files, $labels, $form)
    {
        echo "FORM SUBMITTED!<br>";
        echo "<pre>";
        print_r($submittedData);
        die();
    }
    
}
