<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

namespace BPExtensions\Module\BPSlider\Site\Helper;

use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

/**
 * Helper for BP Slider module.
 *
 * @since 2.0.0
 */
abstract class BPToolbarHelper
{

	/**
	 * Get button url from slide parameters.
	 *
	 * @param   object  $slide  Slide object.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function getButtonUrl(object $slide): string
	{
		switch ($slide->button_type)
		{
			case 'article':
				return Route::_(RouteHelper::getArticleRoute($slide->button_article));
			case 'menu':
				return Route::_('index.php?Itemid=' . $slide->button_menu);
			default:
				return $slide->button_url;
		}
	}

	/**
	 * Prepare and return Swiper options array.
	 *
	 * @param   Registry  $params  Module params.
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public static function getOptions(Registry $params): array
	{
		$id              = $params->get('id');
		$navigation      = (bool) $params->get('navigation', 1);
		$pagination      = (bool) $params->get('pagination', 1);
		$loop            = (bool) $params->get('loop', 1);
		$autoplay        = (bool) $params->get('autoplay', 1);
		$autoplay_delay  = (int) $params->get('autoplay_delay', 4) * 1000;
		$transition_time = (int) $params->get('transition_time', 100);
		$effect          = $params->get('effect', 'slide-horizontal');

		// Process options
		$options = [
			'speed' => $transition_time
		];

		if ($navigation)
		{
			$options['navigation'] = [
				'nextEl' => '#' . $id . '-swiper-button-next',
				'prevEl' => '#' . $id . '-swiper-button-prev',
			];
		}

		if ($pagination)
		{
			$options['pagination'] = [
				'el'        => '#' . $id . '-swiper-pagination',
				'clickable' => true
			];
		}

		if ($autoplay)
		{
			$options['autoplay'] = [
				'delay' => $autoplay_delay
			];
		}

		if ($loop)
		{
			$options['loop'] = 'true';
		}

		if ($effect === 'slide-vertical')
		{
			$options['direction'] = 'vertical';
		}
		else
		{
			$options['effect'] = $effect;
		}

		return $options;
	}

}