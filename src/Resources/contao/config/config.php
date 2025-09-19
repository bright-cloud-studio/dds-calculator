<?php

/**
* @copyright  Bright Cliud Studio
* @author     Bright Cloud Studio
* @package    DDS Calculator
* @license    LGPL-3.0+
* @see	       https://github.com/bright-cloud-studio/dds-calculator
*/

use Contao\System;

/* Hooks */
$GLOBALS['TL_HOOKS']['processFormData'][]        = array('Bcs\Hooks\CalculatorHooks', 'onCalculatorSubmission');

/* Add to Navigation */
$GLOBALS['TL_LANG']['MOD']['dds_calculator'][0] = "DDS Calculator";
$GLOBALS['BE_MOD']['dds_calculator']['calculator_submission'] = array( 'tables' => array('tl_calculator_submission') );

/* Models */
$GLOBALS['TL_MODELS']['tl_calculator_submission']         = 'Bcs\Model\CalculatorSubmission';

/* Front end modules */
$GLOBALS['FE_MOD']['dds_acoustics']['mod_display_calculator_submission'] = 'Bcs\Module\ModDisplayCalculatorSubmission';
