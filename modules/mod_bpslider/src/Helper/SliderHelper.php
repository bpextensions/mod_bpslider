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

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Administrator\Table\ArticleTable;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

/**
 * Helper for BP Slider module.
 *
 * @since 2.0.0
 */
abstract class SliderHelper
{

	/**
	 * Get button url from slide parameters.
	 *
	 * @param   object  $slide  Slide object.
	 *
	 * @return string
	 *
	 * @throws Exception
	 * @since 1.0.0
	 */
	public static function getButtonUrl(object $slide): string
	{
		switch ($slide->button_type)
		{
			case 'article':
				$article_id = (int) $slide->button_article;
				if ($article_id > 0)
				{
					$article_table = new ArticleTable(Factory::getDbo());
					if ($article_table->load($article_id))
					{
						$article = (object) $article_table->getProperties();

						return Route::_(RouteHelper::getArticleRoute($article_id . ':' . $article->alias, $article->catid, $article->language));
					}

				}

				return Route::_(RouteHelper::getArticleRoute($slide->button_article));

			case 'menu':
				return Route::_('index.php?Itemid=' . (int) $slide->button_menu);

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

	/**
	 * Break text into new lines
	 *
	 * @param   string  $text
	 * @param   string  $break_html
	 *
	 * @return string
	 *
	 * @since 2.0.1
	 */
	public static function nl(string $text, string $break_html = '<br />'): string
	{
		return str_ireplace('<br />', $break_html, nl2br($text));
	}

}