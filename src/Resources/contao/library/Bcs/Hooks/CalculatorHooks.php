<?php

namespace Bcs\Hooks;

use Bcs\Model\CalculatorSubmission;
use Contao\Config;

class CalculatorHooks
{
    protected static $arrUserOptions = array();

    // HOOK: On form submission
    public function onCalculatorSubmission($submittedData, $formData, $files, $labels, $form)
    {
        if($formData['formID'] == 'rt60_calc') {
            // Create a new Calculator Submission record
            $calculator_submission = new CalculatorSubmission();
            $calculator_submission->uuid = $this->generateUUID();
            $_SESSION['calculator_submission'] = $calculator_submission->uuid;
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
            
            $floor_alpha = $submittedData['floor_material'];
            $ceiling_alpha = $submittedData['ceiling_material'];
            $wall_alpha = $submittedData['wall_material'];
            
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
    
            // Send data to Zapier
            $data_to_send = array(
                "name" => $submittedData['first_name'] . " " . $submittedData['last_name'],
                "company" => $submittedData['company_name'],
                "project" => $submittedData['project_name'],
                "zip" => $submittedData['zip_code'],
                "phone" => $submittedData['phone_number'],
                "email" => $submittedData['email_address'],
                "length" => $length,
                "width" => $width,
                "height" => $height,
                "floorAlpha" => $floor_alpha,
                "ceilingAlpha" => $ceiling_alpha,
                "wallAlpha" => $wall_alpha,
                "floorMaterial" => $submittedData['floor_material'],
                "ceilingMaterial" => $submittedData['ceiling_material'],
                "wallMaterial" => $submittedData['wall_material'],
                "rt60" => $rt60_fixed,
            );
            $this->sendToZapier($data_to_send);
            
            $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . '/../files/logs/ddc_calc_'.strtolower(date('m_d_y_H:m:s')).".txt", "w") or die("Unable to open file!");
            
            foreach($data_to_send as $key=>$value) {
                fwrite($myfile, "KEY: " . $key . " - VALUE: " . $value . "\r\n");
            }
        }
        
    }

    function sendToZapier($data_to_send) {
        $zapier_webhook_url = Config::get('zapier_webhook'); // Replace with your actual URL

        $ch = curl_init($zapier_webhook_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_to_send));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    function generateUUID() {
        // Generate 16 bytes (128 bits) of random data
        $data = random_bytes(16);
        
        // Set version to 0100 (4) and variant to 10xx (RFC 4122)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set variant to 10xx

        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        
        return $uuid;
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
