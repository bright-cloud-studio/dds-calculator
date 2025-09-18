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
$GLOBALS['TL_HOOKS']['processFormData'][]        = array('Bcs\Hooks\FormHooks', 'onFormSubmit');
$GLOBALS['TL_HOOKS']['compileFormFields'][]      = array('Bcs\Hooks\FormHooks', 'onCompileFormFields');
