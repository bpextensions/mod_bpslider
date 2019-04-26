<?php
/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 */

use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

/**
 * @var Registry $params
 */
/**
 * @var HtmlDocument $doc
 */
$doc = Factory::getDocument();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$layout = $params->get('layout', 'default');
$navigation = (bool)$params->get('navigation', 1);
$pagination = (bool)$params->get('pagination', 1);
$loop = (bool)$params->get('loop', 1);
$autoplay = (bool)$params->get('autoplay', 1);
$autoplay_delay = (int)$params->get('autoplay_delay', 4) * 1000;
$transition_time = (int)$params->get('transition_time', 100);
$slides = (array)$params->get('slides', []);
$id = 'modbpslider' . $module->id;

require ModuleHelper::getLayoutPath('mod_bpslider', $layout);
