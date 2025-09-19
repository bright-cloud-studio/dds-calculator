<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace('{files_legend', '{dds_calc_legend},zapier_webhook;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'zapier_webhook' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['zapier_webhook'],
        'inputType'         => 'text',
        'default'           => '',
        'eval'              => ['tl_class' => 'w100'],
    ],
];
