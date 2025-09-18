<?php

namespace Bcs\Hooks;

use Bcs\Model\CalculatorSubmission

class FormHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onFormSubmit($submittedData, $formData, $files, $labels, $form)
    {
        $calculator_record = new CalculatorRecord();
        $calculator_record->tstamp = time();
        $calculator_record->date_created = time();

        $calculator_record->first_name = $submittedData['first_name'];
        $calculator_record->last_name = $submittedData['last_name'];
        $calculator_record->company_name = $submittedData['company_name'];
        $calculator_record->project_name = $submittedData['project_name'];
        $calculator_record->zip_code = $submittedData['zip_code'];
        $calculator_record->phone_number = $submittedData['phone_number'];
        $calculator_record->email_address = $submittedData['email_address'];

        $calculator_record->room_length = $submittedData['room_length'];
        $calculator_record->room_width = $submittedData['room_width'];
        $calculator_record->room_height = $submittedData['room_height'];
        $calculator_record->floor_material = $submittedData['floor_material'];
        $calculator_record->ceiling_material = $submittedData['ceiling_material'];
        $calculator_record->wall_material = $submittedData['wall_material'];
        
    }
    
}
