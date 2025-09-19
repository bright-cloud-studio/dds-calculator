<?php

namespace Bcs\Hooks;

use Bcs\Model\CalculatorSubmission;

class CalculatorHooks
{
    protected static $arrUserOptions = array();

    // HOOK: On form submission
    public function onCalculatorSubmission($submittedData, $formData, $files, $labels, $form)
    {

        // Create a new Calculator Submission record
        $calculator_submission = new CalculatorSubmission();
        $calculator_submission->tstamp = time();
        $calculator_submission->date_created = time();
        // Step One fields
        $calculator_submission->first_name = $submittedData['first_name'];
        $calculator_submission->last_name = $submittedData['last_name'];
        $calculator_submission->company_name = $submittedData['company_name'];
        $calculator_submission->project_name = $submittedData['project_name'];
        $calculator_submission->zip_code = $submittedData['zip_code'];
        $calculator_submission->phone_number = $submittedData['phone_number'];
        $calculator_submission->email_address = $submittedData['email_address'];
        // Step Two fields
        $calculator_submission->room_length = $submittedData['room_length'];
        $calculator_submission->room_width = $submittedData['room_width'];
        $calculator_submission->room_height = $submittedData['room_height'];
        $calculator_submission->floor_material = $submittedData['floor_material'];
        $calculator_submission->ceiling_material = $submittedData['ceiling_material'];
        $calculator_submission->wall_material = $submittedData['wall_material'];
        
        // Gather all of our base values so we can calculate
        $length = $submittedData['room_length'];
        $width = $submittedData['room_width'];
        $height = $submittedData['room_height'];
        $floor_alpha = $this->getFloorAlpha($submittedData['floor_material']);
        $ceiling_alpha = $this->getCeilingAlpha($submittedData['ceiling_material']);
        $wall_alpha = $this->getWallAlpha($submittedData['wall_material']);
        
        // Calculate RT60 here
        $volume = $length * $width * $height;
        $floor_area = $length * $width;
        $ceiling_area = $floor_area;
        $wall_area = 2 * ($length * $height + $width * $height);
        $a = ($floor_area * $floor_alpha) + ($ceiling_area * $ceiling_alpha) + ($wall_area * $wall_alpha);
        $rt60 = 0.049 * $volume / $a;
        $rt60_fixed = number_format($rt60,2);
        // Save our calculated RT60
        $calculator_submission->result_rt60 = $rt60_fixed;
        // Set our Result Flag based on some comparisons
        if($rt60_fixed > 1.5) {
            $calculator_submission->result_flag = 1;
        } else if($rt60_fixed < 0.6) {
            $calculator_submission->result_flag = 2;
        } else {
            $calcilator_submission->result_flag = 3;
        }
        // Save our Calculator Submission record
        $calculator_submission->save();
        
    }

    // Convert our form value to the number we need for calculation
    function getFloorAlpha($label) {
        switch ($label) {
            case 'concrete':
                return 0.03;
                break;
            case 'wood':
                return 0.10;
                break;
            case 'thin_carpet':
                return 0.10;
                break;
            case 'thick_carpet':
                return 0.25;
                break;
            case 'tile':
                return 0.01;
                break;
            case 'rubber_sports_flooring':
                return 0.10;
                break;
        }
    }
    // Convert our form value to the number we need for calculation
    function getCeilingAlpha($label) {
        switch ($label) {
            case 'gypsum_board':
                return 0.05;
                break;
            case 'metal_deck':
                return 0.04;
                break;
            case 'wood_ceiling':
                return 0.10;
                break;
            case 'contractor_grade_act':
                return 0.35;
                break;
        }
    }
    // Convert our form value to the number we need for calculation
    function getWallAlpha($label) {
        switch ($label) {
            case 'painted_drywall':
                return 0.05;
                break;
            case 'cinder_block':
                return 0.05;
                break;
            case 'brick':
                return 0.03;
                break;
            case 'glass':
                return 0.05;
                break;
        }
    }
    
}
