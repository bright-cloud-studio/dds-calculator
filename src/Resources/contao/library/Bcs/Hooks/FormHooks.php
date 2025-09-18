<?php

namespace Bcs\Hooks;

class FormHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onFormSubmit($submittedData, $formData, $files, $labels, $form)
    {
        // BOOTSTRAP - For triggering one off scripts when the need arises
        if($formData['formID'] == 'dds_calc_step_1') {
          echo "HOOK: FORM HOOKED HOOKFULLY";
          die();
        }
        
    }
  
}
