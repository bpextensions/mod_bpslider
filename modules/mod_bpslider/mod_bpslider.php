<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 */

use BPExtensions\Module\BPSlider\Site\Helper\AssetsHelper;
use BPExtensions\Module\BPSlider\Site\Helper\SliderHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\WebAsset\WebAssetManager;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

/**
 * @var Registry        $params
 * @var stdClass        $module
 * @var WebAssetManager $assetsManager
 */

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''));
$slides          = (array) $params->get('slides', []);
$id              = 'modbpslider' . $module->id;
$navigation      = (bool) $params->get('navigation', 1);
$pagination      = (bool) $params->get('pagination', 1);
$min_height      = (int) $params->get('min_height', 0);
$effect          = $params->get('effect', '');
$layout          = $params->get('layout', 'default');

$params->def('id', $id);

$options       = SliderHelper::getOptions($params);
$assetsManager = Factory::getApplication()->getDocument()->getWebAssetManager();
$assetsHelper  = new AssetsHelper(pathinfo(__FILE__, PATHINFO_FILENAME), $assetsManager);

require ModuleHelper::getLayoutPath('mod_bpslider', $layout);
