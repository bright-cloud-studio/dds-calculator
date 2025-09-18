<?php

namespace Bcs\Hooks;

class FormHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onFormSubmit($submittedData, $formData, $files, $labels, $form)
    {
        // BOOTSTRAP - For triggering one off scripts when the need arises
        if($formData['formID'] == 'dds_step_1') {
          echo "HOOK: FORM HOOKED HOOKFULLY";
          die();
        }
        
    }

    public function onCompileFormFields($arrFields, $formId, $objForm)
    {
        if ($objForm->id == 'dds_step_2') {
            // loop through all of the form fields
            foreach ($arrFields as $field)
            {
                // if we have a value in post that matches this field's name
                if (\Input::post($field->name) != '') 
                    $field->value = \Input::post($field->name);
            }	
        }
        
        // return our modified form fields
        return $arrFields;
    }
    
  
}
