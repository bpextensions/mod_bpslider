<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

/**
 * Helper for mod_bpslider
 */
abstract class ModBPSliderHelper
{

    /**
     * Get button url from slide parameters.
     *
     * @param object $slide Slide object.
     * @return string
     * @since 1.0.0
     */
    public static function getButtonUrl(object $slide): string
    {
        switch ($slide->button_type) {
            case 'article':
                return Route::_(ContentHelperRoute::getArticleRoute($slide->button_article));
                break;
            case 'menu':
                return Route::_('index.php?Itemid=' . $slide->button_menu);

                break;
            default:
                return $slide->button_url;
        }
    }

    /**
     * Get asset url.
     *
     * @param string $url Asset regular url.
     * @return string
     */
    public static function getAssetUrl(string $url): string
    {
        $manifest = json_decode(file_get_contents(JPATH_SITE . '/modules/mod_bpslider/assets/manifest.json'), true);

        $url = ltrim($url, '/');
        if (key_exists($url, $manifest)) {
            $url = $manifest[$url];
        }

        return $url;
    }

    /**
     * Prepare and return Swiper options array.
     *
     * @param Registry $params Module params.
     * @return array
     */
    public static function getOptions(Registry $params): array
    {
        $id = $params->get('id');
        $navigation = (bool)$params->get('navigation', 1);
        $pagination = (bool)$params->get('pagination', 1);
        $loop = (bool)$params->get('loop', 1);
        $autoplay = (bool)$params->get('autoplay', 1);
        $autoplay_delay = (int)$params->get('autoplay_delay', 4) * 1000;
        $transition_time = (int)$params->get('transition_time', 100);
        $effect = $params->get('effect', 'slide-horizontal');

        // Process options
        $options = [
            'speed' => $transition_time
        ];

        if ($navigation) {
            $options['navigation'] = [
                'nextEl' => '#' . $id . '-swiper-button-next',
                'prevEl' => '#' . $id . '-swiper-button-prev',
            ];
        }

        if ($pagination) {
            $options['pagination'] = [
                'el' => '#' . $id . '-swiper-pagination',
                'clickable' => true
            ];
        }

        if ($autoplay) {
            $options['autoplay'] = [
                'delay' => $autoplay_delay
            ];
        }

        if ($loop) {
            $options['loop'] = 'true';
        }

        if ($effect == 'slide-vertical') {
            $options['direction'] = 'vertical';
        } elseif ($effect == 'slide-horizontal') {

        } else {
            $options['effect'] = $effect;
        }

        return $options;
    }

}