<?php

use Contao\Backend;
use Contao\Database;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\Input;
 
/* Table tl_services */
$GLOBALS['TL_DCA']['tl_calculator_submission'] = array
(
 
    // Config
    'config' => array
    (
        'dataContainer'               => DC_Table::class,
        'switchToEdit'                => false,
        'closed'                      => true,
        'notCopyable'                 => true,
        'notDeletable'                => true,
        'backendSearchIgnore'         => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' 	=> 	'primary'
            )
        )
    ),
 
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => DataContainer::MODE_UNSORTED,
            'rootPaste'               => false,
            'flag'                    => DataContainer::SORT_DESC,
            'fields'                  => array('date_created DESC'),
            'icon'                    => 'pagemounts.svg',
            'defaultSearchField'      => 'date_created',
            'panelLayout'             => 'filter;sort,search,limit'
            
        ),
        'label' => array
        (
            'fields'                  => array('first_name', 'last_name', 'email_address'),
            'format'                  => '%s - %s - %s',
            'label_callback'          => array('tl_calculator_submission', 'generateLabel')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_issue']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_issue']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
 
    // Palettes
    'palettes' => array
    (
        'default'                     => '{step_one_details}, first_name, last_name, company_name, project_name, zip_code, phone_number, email_address;{step_two_details}, room_length, room_width, room_height, floor_material, ceiling_material, wall_material;'
    ),
 
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                   => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                   => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
        (
            'sql'                   => "int(10) unsigned NOT NULL default '0'"
        ),

        'date_created' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['date_created'],
            'inputType'               => 'text',
            'default'                 => '',
            'filter'                  => true,
            'search'                  => true,
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(20) NOT NULL default ''",
            'default'                => date('m/d/y g:i a')
        ),

        'email_type' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['email_type'],
            'inputType'               => 'select',
            'default'                 => 'alert_week_remaining',
            'filter'                  => true,
            'search'                  => true,
            'options'                 => array(
                'alert_week_remaining' => 'Alert Email - Week Remaining',
                'alert_final' => 'Alert Email - Final Day',
                'pwf_no_meeting_date_entered' => 'Psych Work Form – No Meeting Date Entered',
                'pwf_no_report_submitted' => 'Psych Work Form – No Report Submitted'
            ),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(30) NOT NULL default ''"
        ),

        'first_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['first_name'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'last_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['last_name'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'company_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['company_name'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'project_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['project_name'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'zip_code' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['zip_code'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'phone_number' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['phone_number'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'email_address' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['email_address'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),



        'room_length' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['room_length'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'room_width' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['room_width'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'room_height' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_calculator_submission']['room_height'],
            'inputType'               => 'text',
            'default'                 => '',
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'floot_material' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email_record']['floor_material'],
            'inputType'               => 'select',
            'default'                 => 'alert_week_remaining',
            'filter'                  => true,
            'search'                  => true,
            'options'                 => array(
                'concrete' => 'Concrete',
                'wood' => 'Wood',
                'thin_carpet' => 'Thin Carpet',
                'thick_carpet' => 'Thick Carpet',
                'tile' => 'Tile',
                'rubber_sports_flooring' => 'Rubber Sports Flooring'
            ),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(30) NOT NULL default ''"
        ),
        'ceiling_material' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email_record']['ceiling_material'],
            'inputType'               => 'select',
            'default'                 => 'alert_week_remaining',
            'filter'                  => true,
            'search'                  => true,
            'options'                 => array(
                'gypsum_board' => 'Gypsum Board',
                'metal_deck' => 'Metal Deck',
                'wood_ceiling' => 'Wood Ceiling',
                'contractor_grade_act' => 'Contractor Grade ACT'
            ),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(30) NOT NULL default ''"
        ),
        'wall_material' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email_record']['wall_material'],
            'inputType'               => 'select',
            'default'                 => 'alert_week_remaining',
            'filter'                  => true,
            'search'                  => true,
            'options'                 => array(
                'painted_drywall' => 'Painted Drywall',
                'cinder_block' => 'Cinder Block',
                'brick' => 'Brick',
                'glass' => 'Glass'
            ),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(30) NOT NULL default ''"
        ),

        
        
    )
);



class tl_calculator_submission extends Backend
{
    public function generateLabel($row, $label, DataContainer|null $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false, $isVisibleRootTrailPage=false)
    {
        // Prepend the label with the date, formatted correctly
        $label = date('m/d/y g:i a', $row['date_created']) . " - " . $label;
        return $label;
    }
}
