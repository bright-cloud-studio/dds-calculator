<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace('{files_legend', '{dds_calc_legend},zapier_webhook,rt60_flag_1,rt60_flag_2,rt60_flag_3;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'zapier_webhook' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['zapier_webhook'],
        'inputType'         => 'text',
        'default'           => '',
        'eval'              => ['tl_class' => 'w100'],
    ],
];

$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'rt60_flag_1' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['rt60_flag_1'],
        'inputType'         => 'textarea',
        'default'           => '',
        'search'            => false,
        'filter'            => false,
        'eval'              => array('mandatory'=>false, 'tl_class'=>'clr w100', 'rte'=>'tinyMCE', 'allowHtml' => true),
        'sql'               => "text NOT NULL default ''"
    ],
];
$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'rt60_flag_2' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['rt60_flag_2'],
        'inputType'         => 'textarea',
        'default'           => '',
        'search'            => false,
        'filter'            => false,
        'eval'              => array('mandatory'=>false, 'tl_class'=>'clr w100', 'rte'=>'tinyMCE', 'allowHtml' => true),
        'sql'               => "text NOT NULL default ''"
    ],
];
$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'rt60_flag_3' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['rt60_flag_3'],
        'inputType'         => 'textarea',
        'default'           => '',
        'search'            => false,
        'filter'            => false,
        'eval'              => array('mandatory'=>false, 'tl_class'=>'clr w100', 'rte'=>'tinyMCE', 'allowHtml' => true),
        'sql'               => "text NOT NULL default ''"
    ],
];
