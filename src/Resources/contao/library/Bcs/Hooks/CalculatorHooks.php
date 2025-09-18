<?php

namespace Bcs\Hooks;

use Bcs\Model\CalculatorSubmission;

class CalculatorHooks
{
    protected static $arrUserOptions = array();

    // When a form is submitted
    public function onCalculatorSubmission($submittedData, $formData, $files, $labels, $form)
    {
        $calculator_submission = new CalculatorSubmission();
        $calculator_submission->tstamp = time();
        $calculator_submission->date_created = time();

        $calculator_submission->first_name = $submittedData['first_name'];
        $calculator_submission->last_name = $submittedData['last_name'];
        $calculator_submission->company_name = $submittedData['company_name'];
        $calculator_submission->project_name = $submittedData['project_name'];
        $calculator_submission->zip_code = $submittedData['zip_code'];
        $calculator_submission->phone_number = $submittedData['phone_number'];
        $calculator_submission->email_address = $submittedData['email_address'];

        $calculator_submission->room_length = $submittedData['room_length'];
        $calculator_submission->room_width = $submittedData['room_width'];
        $calculator_submission->room_height = $submittedData['room_height'];
        $calculator_submission->floor_material = $submittedData['floor_material'];
        $calculator_submission->ceiling_material = $submittedData['ceiling_material'];
        $calculator_submission->wall_material = $submittedData['wall_material'];
        
        $calculator_submission->save();
        
    }
    
}
