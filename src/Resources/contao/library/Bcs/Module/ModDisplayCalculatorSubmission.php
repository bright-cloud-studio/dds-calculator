<?php

namespace Bcs\Module;

use Bcs\Model\CalculatorSubmission;

use Contao\ArrayUtil;
use Contao\Controller;
use Contao\BackendTemplate;
use Contao\FormModel;
use Contao\Input;
use Contao\MemberGroupModel;
use Contao\System;
use Contao\FrontendUser;

class ModDisplayCalculatorSubmission extends \Contao\Module
{

    /* Default Template */
    protected $strTemplate = 'mod_display_calculator_submission';

    /* Construct function */
    public function __construct($objModule, $strColumn='main')
    {
        parent::__construct($objModule, $strColumn);
    }

    /* Generate function */
    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
        {
            $objTemplate = new BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . mb_strtoupper($GLOBALS['TL_LANG']['FMD']['assignments'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;
 
            return $objTemplate->parse();
        }
 
        return parent::generate();
    }

    protected function compile()
    {

        if($_SESSION['calculator_submission']) {
            $uuid = $_SESSION['calculator_submission'];
            $calculator_submission = CalculatorSubmission::findOneBy(['uuid = ?'], [$uuid]);
            if($calculator_submission) {
                
                $submission_details = [];
                
                $submission_details['room_length'] = $calculator_submission->room_length;
                $submission_details['room_width'] = $calculator_submission->room_width;
                $submission_details['room_height'] = $calculator_submission->room_height;
                $submission_details['floor_material'] = $calculator_submission->floor_material;
                $submission_details['ceiling_material'] = $calculator_submission->ceiling_material;
                $submission_details['wall_material'] = $calculator_submission->wall_material;
                
                $submission_details['rt60'] = $calculator_submission->result_rt60;
                $submission_details['flag'] = $calculator_submission->result_flag;
                
                $this->Template->submission_details = $submission_details;
            }
        }
        
    }

}
