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

        }
        
        
    }

}
