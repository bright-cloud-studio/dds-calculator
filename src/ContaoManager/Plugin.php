<?php

/**
 * @copyright  Bright Cliud Studio
 * @author     Bright Cloud Studio
 * @package    DDS Calculator
 * @license    LGPL-3.0+
 * @see	       https://github.com/bright-cloud-studio/dds-calculator
 */

namespace Bcs\DDSCalcBundle\ContaoManager;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Bcs\DDSCalcBundle\BcsDDSCalcBundle')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle']),
        ];
    }
}
