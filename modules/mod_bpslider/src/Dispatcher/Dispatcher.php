<?php

/**
 * @package     ${package}
 * @subpage     ${package}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

namespace BPExtensions\Module\BPSlider\Site\Dispatcher;

use BPExtensions\Module\BPSlider\Site\Helper\AssetsHelper;
use BPExtensions\Module\BPSlider\Site\Helper\SliderHelper;
use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for mod_bpslider
 */
class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    /**
     * Returns the layout data.
     *
     * @return  array
     */
    protected function getLayoutData(): array
    {
        $data   = parent::getLayoutData();
        $params = $data['params'];

        $data['moduleclass_sfx'] = htmlspecialchars($params->get('moduleclass_sfx', ''));
        $data['slides']          = (array)$params->get('slides', []);
        $data['id']              = 'modbpslider' . $this->module->id;
        $params->set('id', $data['id']);

        $data['navigation']    = (bool)$params->get('navigation', 1);
        $data['pagination']    = (bool)$params->get('pagination', 1);
        $data['min_height']    = (int)$params->get('min_height', 0);
        $data['effect']        = $params->get('effect', '');
        $data['layout']        = $params->get('layout', 'default');
        $data['options']       = SliderHelper::getOptions($params);
        $data['assetsManager'] = Factory::getApplication()->getDocument()->getWebAssetManager();
        $data['assetsHelper']  = new AssetsHelper($data['assetsManager']);


        return $data;
    }
}
